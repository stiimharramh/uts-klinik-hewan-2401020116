<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasienHewan extends Model
{
    // Nama tabel yang digunakan
    protected $table = 'pasien_hewan';

    // Kolom yang boleh diisi
    protected $fillable = [
        'kode_pasien',
        'nama_hewan',
        'nomor_rekam',
        'usia_tahun',
        'jenis_hewan_id',
    ];

    // Relasi: pasien memiliki satu jenis hewan
    public function jenisHewan()
    {
        return $this->belongsTo(JenisHewan::class, 'jenis_hewan_id');
    }
}
