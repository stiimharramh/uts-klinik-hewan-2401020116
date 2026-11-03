<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pasien Hewan</title>
</head>
<body>

    <h1>Edit Data Pasien Hewan</h1>

    <a href="{{ route('pasien-hewan.index') }}">Kembali ke Daftar Pasien</a>

    <br><br>

    @if ($errors->any())
        <div>
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pasien-hewan.update', $pasien->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Kode Pasien:</label><br>
        <input type="text" name="kode_pasien"
               value="{{ old('kode_pasien', $pasien->kode_pasien) }}" required>
        <br><br>

        <label>Nama Hewan:</label><br>
        <input type="text" name="nama_hewan"
               value="{{ old('nama_hewan', $pasien->nama_hewan) }}" required>
        <br><br>

        <label>Nomor Rekam:</label><br>
        <input type="text" name="nomor_rekam"
               value="{{ old('nomor_rekam', $pasien->nomor_rekam) }}" required>
        <br><br>

        <label>Usia (Tahun):</label><br>
        <input type="number" name="usia_tahun"
               value="{{ old('usia_tahun', $pasien->usia_tahun) }}" min="0" max="30" required>
        <br><br>

        <label>Jenis Hewan:</label><br>
        <select name="jenis_hewan_id" required>
            @foreach ($jenisHewan as $jenis)
                <option value="{{ $jenis->id }}"
                    {{ old('jenis_hewan_id', $pasien->jenis_hewan_id) == $jenis->id ? 'selected' : '' }}>
                    {{ $jenis->nama_jenis }}
                </option>
            @endforeach
        </select>
        <br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>

</body>
</html>
