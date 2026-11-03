
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel jenis_hewan
     */
    public function up(): void
    {
        Schema::create('jenis_hewan', function (Blueprint $table) {
            $table->id(); // Primary key: BIGINT UNSIGNED AUTO_INCREMENT
            $table->string('nama_jenis', 100)->unique(); // Nama jenis hewan, maksimal 100 karakter dan unik
        });
    }

    /**
     * Menghapus tabel jenis_hewan jika migration di-rollback
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_hewan');
    }
};
