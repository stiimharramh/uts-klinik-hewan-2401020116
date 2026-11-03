<?php

namespace App\Http\Controllers;

use App\Models\PasienHewan;
use App\Models\JenisHewan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PasienHewanController extends Controller
{
    // Menampilkan daftar pasien, pencarian, dan filter jenis hewan
    public function index(Request $request)
    {
        $query = PasienHewan::with('jenisHewan');

        // Search kode pasien, nama hewan, atau nomor rekam
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('kode_pasien', 'like', "%$search%")
                  ->orWhere('nama_hewan', 'like', "%$search%")
                  ->orWhere('nomor_rekam', 'like', "%$search%");
            });
        }

        // Filter berdasarkan jenis hewan
        if ($request->filled('jenis_hewan_id')) {
            $query->where('jenis_hewan_id', $request->jenis_hewan_id);
        }

        $pasien = $query->latest()->get();
        $jenisHewan = JenisHewan::all();

        return view('pasien-hewan.index', compact('pasien', 'jenisHewan'));
    }

    // Menyimpan pasien baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_pasien' => ['required', 'alpha_num', 'size:10', 'unique:pasien_hewan,kode_pasien'],
            'nama_hewan' => ['required', 'string', 'min:2', 'max:100'],
            'nomor_rekam' => ['required', 'string', 'min:5', 'max:30', 'unique:pasien_hewan,nomor_rekam'],
            'usia_tahun' => ['required', 'integer', 'min:0', 'max:30'],
            'jenis_hewan_id' => ['required', 'exists:jenis_hewan,id'],
        ]);

        PasienHewan::create($request->all());

        return redirect()->route('pasien-hewan.index')
                       ->with('success', 'Pasien hewan berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $pasien = PasienHewan::findOrFail($id);
        $jenisHewan = JenisHewan::all();

        return view('pasien-hewan.edit', compact('pasien', 'jenisHewan'));
    }

    // Memperbarui data pasien
    public function update(Request $request, $id)
    {
        $pasien = PasienHewan::findOrFail($id);

        $request->validate([
            'kode_pasien' => ['required', 'alpha_num', 'size:10', Rule::unique('pasien_hewan', 'kode_pasien')->ignore($pasien->id)],
            'nama_hewan' => ['required', 'string', 'min:2', 'max:100'],
            'nomor_rekam' => ['required', 'string', 'min:5', 'max:30', Rule::unique('pasien_hewan', 'nomor_rekam')->ignore($pasien->id)],
            'usia_tahun' => ['required', 'integer', 'min:0', 'max:30'],
            'jenis_hewan_id' => ['required', 'exists:jenis_hewan,id'],
        ]);

        $pasien->update($request->all());

        return redirect()->route('pasien-hewan.index')
                       ->with('success', 'Data pasien hewan berhasil diperbarui.');
    }

    // Menghapus pasien
    public function destroy($id)
    {
        $pasien = PasienHewan::findOrFail($id);
        $pasien->delete();

        return redirect()->route('pasien-hewan.index')
                       ->with('success', 'Pasien hewan berhasil dihapus.');
    }

    // Fungsi status usia hewan
    public function statusUsiaHewan($usia)
    {
        return $usia >= 3 ? 'Dewasa' : 'Muda';
    }
}
