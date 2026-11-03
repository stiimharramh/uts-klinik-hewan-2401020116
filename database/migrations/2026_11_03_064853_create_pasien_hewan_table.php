
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Untuk menjalankan SQL CHECK constraint

return new class extends Migration
{
    /**
     * Membuat tabel pasien_hewan
     */
    public function up(): void
    {
        // Membuat tabel pasien_hewan beserta kolom-kolomnya
        Schema::create('pasien_hewan', function (Blueprint $table) {
            $table->id(); // Primary key

            $table->char('kode_pasien', 10)->unique(); // Kode pasien unik
            $table->string('nama_hewan', 100); // Nama hewan
            $table->string('nomor_rekam', 30)->unique(); // Nomor rekam medis unik

            $table->unsignedTinyInteger('usia_tahun'); // Usia 0-30 tahun

            $table->foreignId('jenis_hewan_id')
                  ->constrained('jenis_hewan'); // FK ke jenis_hewan

            $table->timestamps(); // created_at dan updated_at
        });

        // Membatasi usia hewan antara 0 sampai 30 tahun
        DB::statement(
            'ALTER TABLE pasien_hewan ADD CONSTRAINT chk_usia_hewan CHECK (usia_tahun BETWEEN 0 AND 30)'
        );
    }

    /**
     * Menghapus tabel pasien_hewan saat rollback
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien_hewan');
    }
};
