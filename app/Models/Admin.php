<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    use HasFactory, HasApiTokens;  // Menambahkan HasApiTokens agar model dapat menggunakan Sanctum

    protected $table = 'admins';  // Nama tabel

    // Tentukan kolom yang boleh diisi
    protected $fillable = ['email', 'password', 'username'];

    // Tentukan kolom yang tidak bisa diisi
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // Enkripsi password sebelum disimpan dengan menggunakan Hash::make() dari Laravel
    public static function boot()
    {
        parent::boot();

        static::saving(function ($admin) {
            if (isset($admin->password) && !empty($admin->password)) {
                $admin->password = Hash::make($admin->password);  // Menggunakan Hash::make() untuk enkripsi
            }
        });
    }
}
