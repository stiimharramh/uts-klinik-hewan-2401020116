<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisHewan extends Model
{
    // Nama tabel yang digunakan
    protected $table = 'jenis_hewan';

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama_jenis',
    ];

    // Relasi: satu jenis hewan memiliki banyak pasien
    public function pasien()
    {
        return $this->hasMany(PasienHewan::class, 'jenis_hewan_id');
    }
}
