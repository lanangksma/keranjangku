<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function edit()
    {
        // Dapatkan alamat pengguna saat ini jika ada
        $user = auth()->user();
        $address = $user->address;

        return view('profile.edit', compact('address'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Validasi input form alamat
        $validatedData = $request->validate([
            'street' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
        ]);

        // Cek apakah pengguna sudah memiliki alamat, jika iya, update; jika tidak, buat yang baru
        if ($user->address) {
            $user->address->update($validatedData);
        } else {
            $user->address()->create($validatedData);
        }

        return redirect()->back()->with('status', 'Address updated successfully!');
    }
}
