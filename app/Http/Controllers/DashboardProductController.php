<?php

namespace App\Http\Controllers;

use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class DashboardProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();

        // Get the products
        $response = $client->get('https://fakestoreapi.com/products');
        $products = json_decode($response->getBody(), true);

        // Get the categories
        $response = $client->get('https://fakestoreapi.com/products/categories');
        $categories = json_decode($response->getBody(), true);

        return view('dashboard.product.index', [
            'products' => $products, 'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // If you have predefined categories, you can use them here
        $categories = ['Category 1', 'Category 2', 'Category 3'];

        // Return the view with the necessary data for creating a new product
        return View::make('dashboard.product.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required|numeric|min:0',
        ]);

        // Simpan data produk ke dalam model Product atau sumber data lainnya
        $product = new Product();
        $product->title = $validatedData['title'];
        $product->description = $validatedData['description'];
        $product->category = $validatedData['category'];
        $product->price = $validatedData['price'];
        $product->image = 'https://via.placeholder.com/150';
        $product->count = 0;
        $product->save();

        // Redirect ke halaman yang sesuai setelah menyimpan produk
        return Redirect::route('dashboardProducts.index')->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
