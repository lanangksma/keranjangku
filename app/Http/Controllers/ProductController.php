<?php

namespace App\Http\Controllers;

use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
//    Inisialisasi API
    public function index()
    {
        $client = new Client();
        $response = $client->get('https://fakestoreapi.com/products');
        $data = json_decode($response->getBody(), true);

        // lakukan sesuatu dengan data
        return view('product.index', ['products' => $data]);
    }

//    Mengambil data dari API
    public function fetchProduct()
    {
        $client = new Client();
        $response = $client->get('https://fakestoreapi.com/products');
        $data = json_decode($response->getBody(), true);

        foreach ($data as $productData) {
            $product = new Product;
            $product->title = $productData['title'];
            $product->price = $productData['price'];
            $product->description = $productData['description'];
            $product->category = $productData['category'];
            $product->image = $productData['image'];
            $product->count = $productData['count'];
            $product->save();
        }

    }

//    get product by category
    public function getProductsByCategory($category)
    {
        $client = new Client();
        $response = $client->get('https://fakestoreapi.com/products/category/' . $category);
        $products = json_decode($response->getBody(), true);

        return view('product.index', compact('products'));
    }

    public function show($id)
    {
        $response = Http::get("https://fakestoreapi.com/products/{$id}");

        if ($response->successful()) {
            $product = $response->json();
            return view('products.show', ['product' => $product]);
        }

        // Handle error jika permintaan tidak berhasil
        return redirect()->back()->withErrors(['Failed to fetch product details.']);
    }


//    menyimpan data dari API
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'category' => ['required', 'string'],
            'image' => ['required', 'string'],
            'count' => ['nullable', 'numeric'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Product::create($request->all());

        return redirect()->back()->with('success', 'Product created successfully.');
    }


}
