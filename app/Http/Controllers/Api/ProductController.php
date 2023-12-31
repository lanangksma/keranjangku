<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // -----------------------------------------------------------------------------------------Menampilkan semua produk
    public function index()
    {
        $products = Product::with('category')->get();

        if ($products->count() > 0) {
            // ------------------Mengambil data kategori untuk setiap produk dan menampilkan nama kategori dalam respons
            $formattedProducts = $products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'title' => $product->title,
                    'price' => $product->price,
                    'description' => $product->description,
                    'category' => $product->category->name, // Mengambil nama kategori
                    'image' => $product->image,
                    'count' => $product->count,
                ];
            });
            // ----------------------------------------------------------------------------Respons jika produk ditemukan
            return response()->json([
                'status' => 'success',
                'message' => 'Data products berhasil ditampilkan',
                'data' => $formattedProducts
            ], 200);
        } else {
            // -------------------------------------------------------------Respons jika tidak ada produk yang ditemukan
            return response()->json([
                'status' => 'error',
                'message' => 'Data products tidak ditemukan',
                'data' => null
            ], 404);
        }
    }

    // -------------------------------------------------------------------------Menampilkan detail produk berdasarkan ID
    public function show($id)
    {
        $product = Product::find($id);

        if ($product) {
            // --------------------------------------------------------------------Respons berhasil dengan detail produk
            return response()->json([
                'status' => 'success',
                'message' => 'Data product berhasil ditampilkan',
                'data' => $product
            ], 200);
        } else {
            // ----------------------------------------------------------------------Respons jika produk tidak ditemukan
            return response()->json([
                'status' => 'error',
                'message' => 'Data product tidak ditemukan',
                'data' => null
            ], 404);
        }
    }

    // ---------------------------------------------------------------------------Menampilkan form untuk mengedit produk
    public function edit($id)
    {
        // ------------------------------------------------------------------------------------Logika sama dengan show()
        $product = Product::find($id);

        if ($product) {
            // -------------------------------------------------------------------Respons berhasil menampilkan form edit
            return response()->json([
                'status' => 'success',
                'message' => 'Form edit product berhasil ditampilkan',
                'data' => $product
            ], 200);
        } else {
            // ----------------------------------------------------------------------Respons jika produk tidak ditemukan
            return response()->json([
                'status' => 'error',
                'message' => 'Data product tidak ditemukan',
                'data' => null
            ], 404);
        }
    }

    // ---------------------------------------------------------------------------Memperbarui data produk berdasarkan ID
    public function update(Request $request, $id)
    {
        // -------------------------------------------------------------------------Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'max:255'],
            'price' => ['required'],
            'description' => ['required'],
            'category_id' => ['required', 'exists:categories,id'], // Penambahan validasi untuk category_id
            'count' => ['required'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ]);

        // ---------------------------------------------------Jika validasi gagal, kembalikan respons dengan pesan error
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Data products gagal diupdate',
                'data' => $validator->errors()
            ], 422);
        } else {
            // Ambil data produk berdasarkan ID
            $product = Product::find($id);

            if ($product) {
                // -------------------------------------------------------Update atribut produk dengan data dari request
                $product->title = $request->title;
                $product->price = $request->price;
                $product->description = $request->description;
                $product->category_id = $request->category_id;
                $product->count = $request->count;

                // ---------------------------------------------------------------------Proses file gambar jika diunggah
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $name = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/images');
                    $image->move($destinationPath, $name);
                    $product->image = $name; // Tetapkan nama file gambar ke atribut 'image' produk
                } else {
                    // Jika tidak ada file gambar yang diunggah, tetapkan URL gambar default di sini
                    $product->image = 'https://via.placeholder.com/150';
                }

                // ------------------------------------------------------------------------------Simpan perubahan produk
                if ($product->save()) {
                    // Respons berhasil saat produk diupdate
                    // Ambil nama kategori setelah update
                    $category_name = $product->category->name;

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Data product berhasil diupdate',
                        'data' => [
                            'product' => $product,
                            'category_name' => $category_name // Tambahkan nama kategori dalam respons
                        ]
                    ], 200);
                } else {
                    // ----------------------------------------------------Respons jika gagal menyimpan perubahan produk
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Data product gagal diupdate',
                        'data' => null
                    ], 500);
                }
            } else {
                // ------------------------------------------------------------------Respons jika produk tidak ditemukan
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data product tidak ditemukan',
                    'data' => null
                ], 404);
            }
        }
    }

    // ---------------------------------------------------------------------------------------Menyimpan data produk baru
    public function store(Request $request)
    {
        // -------------------------------------------------------------------------Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'max:255'],
            'price' => ['required'],
            'description' => ['required'],
            'category_id' => ['required', 'exists:categories,id'], // Penambahan validasi untuk category_id
            'count' => ['required'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ]);

        // ---------------------------------------------------Jika validasi gagal, kembalikan respons dengan pesan error
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Data products gagal ditambahkan',
                'data' => $validator->errors()
            ], 422);
        } else {
            // -------------------------------------------Buat instance baru dari model Product dengan data dari request
            $product = new Product([
                'title' => $request->title,
                'price' => $request->price,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'count' => $request->count,
            ]);

            // -------------------------------------------------------------------------Proses file gambar jika diunggah
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $image->move($destinationPath, $name);
                $product->image = $name; // Tetapkan nama file gambar ke atribut 'image' produk
            } else {
                // ------------------------Jika tidak ada file gambar yang diunggah, tetapkan URL gambar default di sini
                $product->image = 'https://via.placeholder.com/150';
            }

            // --------------------------------------------------------------------------Simpan produk ke dalam database
            if ($product->save()) {
                // -------------------------------------------------------------Respons berhasil saat produk ditambahkan
                // ----------------------------------------------------------------------------------Ambil nama kategori
                $category_name = $product->category->name;
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data product berhasil ditambahkan',
                    'data' => [
                        'product' => $product,
                        'category_name' => $category_name // ----------------------Tambahkan nama kategori dalam respons
                    ]
                ], 201);
            } else {
                // -------------------------------------------------------------Respons jika gagal menyimpan produk baru
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data product gagal ditambahkan',
                    'data' => null
                ], 500);
            }
        }
    }

    // ----------------------------------------------------------------------------------Menghapus produk berdasarkan ID
    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            if ($product->delete()) {
                // -----------------------------------------------------------------Respons berhasil saat produk dihapus
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data product berhasil dihapus',
                    'data' => $product
                ], 200);
            } else {
                // ------------------------------------------------------------------Respons jika gagal menghapus produk
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data product gagal dihapus',
                    'data' => null
                ], 500);
            }
        } else {
            // ----------------------------------------------------------------------Respons jika produk tidak ditemukan
            return response()->json([
                'status' => 'error',
                'message' => 'Data product tidak ditemukan',
                'data' => null
            ], 404);
        }
    }
}
