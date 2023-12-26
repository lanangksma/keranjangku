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
            'price' => 'required|numeric|min:0|max:99999999999',
        ]);

        // Simpan data produk ke dalam model Product atau sumber data lainnya
        $product = new Product();
        $product->title = $validatedData['title'];
        $product->description = $validatedData['description'];
        $product->category = $validatedData['category'];
        $product->price = $validatedData['price'];
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
        } else {
            $product->image = 'https://via.placeholder.com/150'; // Tautan gambar default jika tidak ada file diunggah
        }
        $product->count = 0;
        $product->save();

        // Redirect ke halaman yang sesuai setelah menyimpan produk
        return Redirect::route('products.index')->with('success', 'Product added successfully');
    }



    /**
     * Display the specified resource.
     */
//    public function show(Product $product)
//    {
//        return view('dashboard.product.details', ['product' => $product]);
//    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $client = new Client();

        try {
            $response = $client->get("https://fakestoreapi.com/products/{$id}");

            $statusCode = $response->getStatusCode();
            if ($statusCode === 200) {
                $product = json_decode($response->getBody(), true);
                return view('dashboard.product.details', compact('product'));
            } else {
                // Handle other status codes if needed
                return redirect()->back()->with('error', 'Failed to fetch product details.');
            }
        } catch (\Exception $e) {
            // Handle exceptions, like connection errors
            return redirect()->back()->with('error', 'An error occurred while fetching product details.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required|numeric|min:0|max:99999999999',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update fields based on validated data
        $product->update($validatedData);

        // Update image if a new one is uploaded
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
