<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // ---------------------------------------------------------------------------------------Menampilkan semua category
    public function index()
    {
        $categories = Category::all();

        if ($categories->count() > 0) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data categories berhasil ditampilkan',
                'data' => $categories
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data categories tidak ditemukan',
                'data' => null
            ], 404);
        }
    }

    // -----------------------------------------------------------------------Menampilkan detail category berdasarkan ID
    public function show($id)
    {
        $category = Category::find($id);

        if ($category) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data category berhasil ditampilkan',
                'data' => $category
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data category tidak ditemukan',
                'data' => null
            ], 404);
        }
    }

    // -------------------------------------------------------------------------Menampilkan form untuk mengedit category
    public function edit($id)
    {
        $category = Category::find($id);

        if ($category) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data category berhasil ditampilkan',
                'data' => $category
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data category tidak ditemukan',
                'data' => null
            ], 404);
        }
    }

    // -------------------------------------------------------------------------Memperbarui data category berdasarkan ID
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            // Tambahkan validasi untuk atribut lain jika diperlukan
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Data category gagal diupdate',
                'data' => $validator->errors()
            ], 422);
        } else {
            $category = Category::find($id);

            if ($category) {
                $category->name = $request->name;
                // Ubah atribut lain jika diperlukan

                if ($category->save()) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Data category berhasil diupdate',
                        'data' => $category
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Data category gagal diupdate',
                        'data' => null
                    ], 500);
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data category tidak ditemukan',
                    'data' => null
                ], 404);
            }
        }
    }

    // -------------------------------------------------------------------------------------Menyimpan data category baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            // Tambahkan validasi untuk kolom lain jika diperlukan
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Data category gagal ditambahkan',
                'data' => $validator->errors()
            ], 422);
        } else {
            $category = Category::create([
                'name' => $request->name,
                // Masukkan atribut lain jika ada
            ]);

            if ($category) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data category berhasil ditambahkan',
                    'data' => $category
                ], 201);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data category gagal ditambahkan',
                    'data' => null
                ], 500);
            }
        }
    }

    // --------------------------------------------------------------------------------Menghapus category berdasarkan ID
    public function destroy($id)
    {
        $category = Category::find($id);

        if ($category) {
            if ($category->delete()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data category berhasil dihapus',
                    'data' => $category
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data category gagal dihapus',
                    'data' => null
                ], 500);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data category tidak ditemukan',
                'data' => null
            ], 404);
        }
    }
}
