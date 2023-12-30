<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class DashboardProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();

        return view('dashboard.product.index', ['products' => $products, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // If you have predefined categories, you can use them here
        $categories = Category::all();

        // Return the view with the necessary data for creating a new product
        return View('dashboard.product.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required|numeric|min:0|max:99999999999',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Cari kategori atau buat kategori baru jika tidak ditemukan
        $category = Category::firstOrCreate(['name' => $validatedData['category']]);

        $product = new Product();
        $product->title = $validatedData['title'];
        $product->description = $validatedData['description'];
        $product->category_id = $category->id;
        $product->price = $validatedData['price'];

        // Image handling
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
        } else {
            $product->image = 'https://via.placeholder.com/150';
        }
        $product->count = 0;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product added successfully');
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
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('dashboard.product.details', ['product' => $product, 'categories' => $categories]);
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

        // Check if a new image is uploaded and delete old image
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($request->oldImage) {
                Storage::disk('public')->delete($request->oldImage);
            }

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

    public function generatePDF()
    {
        $products = Product::limit(20)->get(); // Get all products (lazy loading

        $pdf = Pdf::loadView('products.pdf_view', compact('products'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('products.pdf');
    }

}
