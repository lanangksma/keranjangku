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

}
