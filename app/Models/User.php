<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';  // Nama tabel

    // Tentukan kolom yang boleh diisi
    protected $fillable = ['nama', 'kota', 'usia', 'tinggi', 'berat'];

    // Tentukan kolom yang tidak bisa diisi
    protected $guarded = ['id', 'tanggal', 'hasil', 'kategori'];

    // Pengaturan timestamp otomatis
    public $timestamps = true;

    // Aksesors untuk hasil BMI dan kategori
    public function setHasilAttribute()
    {
        // Menghitung BMI
        $tinggiMeter = $this->tinggi / 100;
        $bmi = $this->berat / ($tinggiMeter * $tinggiMeter);
        $this->attributes['hasil'] = number_format($bmi, 2);

        // Menentukan kategori berdasarkan BMI
        if ($bmi < 18.5) {
            $this->attributes['kategori'] = 'Kekurangan Berat Badan';
        } elseif ($bmi >= 18.5 && $bmi < 24.9) {
            $this->attributes['kategori'] = 'Berat Badan Normal';
        } elseif ($bmi >= 25 && $bmi < 29.9) {
            $this->attributes['kategori'] = 'Kelebihan Berat Badan';
        } else {
            $this->attributes['kategori'] = 'Kegemukan (Obesitas)';
        }
    }
}
