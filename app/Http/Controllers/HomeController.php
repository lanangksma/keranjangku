<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

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

    public function search(Request $request)
    {
        $client = new Client();

        $searchTerm = $request->input('search');

        // Get all products
        $productsResponse = $client->get('https://fakestoreapi.com/products');
        $products = json_decode($productsResponse->getBody(), true);

        // Filter products based on search term
        $filteredProducts = array_filter($products, function ($product) use ($searchTerm) {
            return str_contains(strtolower($product['title']), strtolower($searchTerm));
        });

        // Get the categories from the API
        $categoriesResponse = $client->get('https://fakestoreapi.com/products/categories');
        $categories = json_decode($categoriesResponse->getBody(), true);

        // Get the products & category from DB
        $productsDB = Product::where('description', 'LIKE', "%$searchTerm%")->get();
        $categoriesDB = Category::limit(4)->get();

        return view('frontstore.home', [
            'products' => $filteredProducts,
            'categories' => $categories,
            'productsDB' => $productsDB,
            'categoriesDB' => $categoriesDB,
        ]);
    }


}
