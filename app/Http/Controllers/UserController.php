<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUsersPage()
    {
        return view('datauser');  // Mengarahkan ke file resources/views/datauser.blade.php
    }

    
    // Menampilkan daftar pengguna
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // UserController.php
public function show($id)
{
    $user = User::find($id);

    if ($user) {
        return response()->json($user);
    } else {
        return response()->json(['message' => 'User not found'], 404);
    }
}

    // Menambahkan pengguna baru
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'kota' => 'required|max:100',
            'usia' => 'required|integer',
            'tinggi' => 'required|numeric',
            'berat' => 'required|numeric',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.max' => 'Nama maksimal 100 karakter.',
            'kota.required' => 'Kota harus diisi.',
            'kota.max' => 'Kota maksimal 100 karakter.',
            'usia.required' => 'Usia harus diisi.',
            'usia.integer' => 'Usia harus berupa angka.',
            'tinggi.required' => 'Tinggi badan harus diisi.',
            'tinggi.numeric' => 'Tinggi badan harus berupa angka.',
            'berat.required' => 'Berat badan harus diisi.',
            'berat.numeric' => 'Berat badan harus berupa angka.',
        ]);

        try {
            User::create([
                'nama' => $request->nama,
                'kota' => $request->kota,
                'usia' => $request->usia,
                'tinggi' => $request->tinggi,
                'berat' => $request->berat,
            ]);

            return response()->json(['message' => 'Pengguna berhasil ditambahkan'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // Edit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'kota' => 'required|max:100',
            'usia' => 'required|integer',
            'tinggi' => 'required|numeric',
            'berat' => 'required|numeric',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.max' => 'Nama maksimal 100 karakter.',
            'kota.required' => 'Kota harus diisi.',
            'kota.max' => 'Kota maksimal 100 karakter.',
            'usia.required' => 'Usia harus diisi.',
            'usia.integer' => 'Usia harus berupa angka.',
            'tinggi.required' => 'Tinggi badan harus diisi.',
            'tinggi.numeric' => 'Tinggi badan harus berupa angka.',
            'berat.required' => 'Berat badan harus diisi.',
            'berat.numeric' => 'Berat badan harus berupa angka.',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->update([
                'nama' => $request->nama,
                'kota' => $request->kota,
                'usia' => $request->usia,
                'tinggi' => $request->tinggi,
                'berat' => $request->berat,
            ]);

            return response()->json(['message' => 'Pengguna berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
