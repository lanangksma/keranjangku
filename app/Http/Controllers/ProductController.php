<?php

namespace App\Http\Controllers;

use App\Models\Product;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $client = new Client();
        $response = $client->get('https://fakestoreapi.com/products');
        $data = json_decode($response->getBody(), true);

        $validator = Validator::make($data, [
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'category' => 'required|string',
            'image' => 'required|string',
            'count' => 'required|integer',
        ]);

        $product = new Product();
        $product->title = $data['title'];
        $product->price = $data['price'];
        $product->description = $data['description'];
        $product->category = $data['category'];
        $product->image = $data['image'];
        $product->count = 1;
    }
}
