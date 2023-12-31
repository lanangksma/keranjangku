<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use function Pest\Laravel\get;

class HomeController extends Controller
{
    public function index()
    {
        $client = new Client();

        // Get the products
        $response = $client->get('https://fakestoreapi.com/products');
        $products = json_decode($response->getBody(), true);

        // Get the categories
        $response = $client->get('https://fakestoreapi.com/products/categories');
        $categories = json_decode($response->getBody(), true);

        // Get the products & category from DB
        $productsDB = Product::all();
        $categoriesDB = Category::limit(4)->get();

        // Return the view with both products and categories
        return view('frontstore.home', ['products' => $products, 'categories' => $categories, 'productsDB' => $productsDB, 'categoriesDB' => $categoriesDB]);
    }

    public function search()
    {
        $searchQuery = request('search');
        $selectedCategory = request('category'); // Ambil kategori yang dipilih

        // Mengambil produk dari API dengan filter pencarian dan kategori
        $apiProducts = $this->fetchApiProducts($searchQuery, $selectedCategory);

        $productsDB = Product::query();

        // Filter berdasarkan pencarian di kolom 'title'
        if ($searchQuery) {
            $productsDB->where('title', 'like', '%' . $searchQuery . '%');
        }

        // Filter berdasarkan kategori yang dipilih
        if ($selectedCategory) {
            $productsDB->whereHas('category', function ($query) use ($selectedCategory) {
                $query->where('name', $selectedCategory);
            });
        }

        $dbProducts = $productsDB->get();

        // Mengambil kategori dari API
        $categories = $this->fetchApiCategories();

        // Mengambil kategori dari database
        $categoriesDB = Category::limit(4)->get();

        return view('frontstore.home', [
            'products' => $apiProducts,
            'productsDB' => $dbProducts,
            'categories' => $categories,
            'categoriesDB' => $categoriesDB
        ]);
    }

// Fungsi untuk mengambil produk dari API berdasarkan pencarian
    private function fetchApiProducts($searchQuery, $category = null)
    {
        $client = new Client();
        $response = $client->get('https://fakestoreapi.com/products');
        $apiProducts = json_decode($response->getBody(), true);

        // Filter berdasarkan pencarian
        if ($searchQuery) {
            $apiProducts = collect($apiProducts)->filter(function ($product) use ($searchQuery) {
                return stripos($product['title'], $searchQuery) !== false;
            })->values()->all();
        }

        // Filter berdasarkan kategori jika ada kategori yang dipilih
        if ($category) {
            $apiProducts = collect($apiProducts)->filter(function ($product) use ($category) {
                return $product['category'] === $category;
            })->values()->all();
        }

        return $apiProducts;
    }

// Fungsi untuk mengambil kategori dari API
    private function fetchApiCategories()
    {
        $client = new Client();
        $response = $client->get('https://fakestoreapi.com/products/categories');
        return json_decode($response->getBody(), true);
    }

}
