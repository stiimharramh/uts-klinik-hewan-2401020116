
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienHewanController;

// Route halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Route CRUD pasien hewan
Route::resource('pasien-hewan', PasienHewanController::class);
