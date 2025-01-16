<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function showAdminsPage()
    {
        return view('admins');  // Mengarahkan ke file resources/views/admins.blade.php
    }
    
    
    // Menampilkan daftar admin
    public function index()
    {
        $admins = Admin::all();
        return response()->json($admins);
    }


    public function show($id)
{
    $admin = Admin::find($id);

    if ($admin) {
        return response()->json($admin);
    } else {
        return response()->json(['message' => 'Admin not found'], 404);
    }
}


    // Menambahkan admin baru
    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8',
            'username' => 'required|max:50',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password harus terdiri dari minimal 8 karakter.',
            'username.required' => 'Username harus diisi.',
            'username.max' => 'Username maksimal 50 karakter.',
        ]);

        try {
            Admin::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'username' => $request->username,
            ]);

            return response()->json(['message' => 'Admin berhasil ditambahkan'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // Edit admin
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|unique:admins,email,' . $id,
            'username' => 'required|max:50',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'username.required' => 'Username harus diisi.',
            'username.max' => 'Username maksimal 50 karakter.',
        ]);

        try {
            $admin = Admin::findOrFail($id);
            $admin->update([
                'email' => $request->email,
                'username' => $request->username,
            ]);

            if ($request->password) {
                $admin->password = bcrypt($request->password);
                $admin->save();
            }

            return response()->json(['message' => 'Admin berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
