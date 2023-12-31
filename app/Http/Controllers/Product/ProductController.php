<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // -----------------------------------------------------------------------------------------------Menampilkan Produk
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    // -----------------------------------------------------------------------------------Menampilkan Form Tambah Produk
    public function create()
    {
        return view('product.create');
    }

    // -------------------------------------------------------------------------------------Menyimpan Produk ke Database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:products|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048|url',
            'category_id' => 'required|exists:categories,id',
            'count' => 'required|numeric',
        ]);

        // --------------------------------------------------------------------Simpan data produk ke dalam model Product
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->description = $validatedData['description'];
        $product->image = $validatedData['image'];
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
        } else {
            $product->image = 'https://via.placeholder.com/150';
        }
        $product->category_id = $validatedData['category_id'];
        $product->count = $validatedData['count'];
        $product->save();

        return redirect('/product')->with('success', 'Product is successfully saved');
    }

    // ----------------------------------------------------------------------------------------Menampilkan Detail Produk
    public function show(string $id)
    {
        $id = Product::findOrFail($id);
    }

    // -------------------------------------------------------------------------------------Menampilkan Form Edit Produk
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }

    // ---------------------------------------------------------------------------Memperbarui Data Produk Berdasarkan id
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:products|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048|url',
            'category_id' => 'required|exists:categories,id',
            'count' => 'required|numeric',
        ]);

        // ---------------------------------------------------------------------------Mencari data produk berdasarkan id
        $product = Product::findOrFail($id);
        // --------------------------------------------------------------------Simpan data produk ke dalam model Product
        $product->update($validatedData);

        return redirect('/product')->with('success', 'Product is successfully updated');
    }

    // -----------------------------------------------------------------------------Menghapus Data Produk Berdasarkan id
    public function destroy(string $id)
    {
        // ---------------------------------------------------------------------------Mencari data produk berdasarkan id
        $product = Product::findOrFail($id);
        // --------------------------------------------------------------------------------------------Hapus data produk
        $product->delete();

        return redirect('/product')->with('success', 'Product is successfully deleted');
    }
}
