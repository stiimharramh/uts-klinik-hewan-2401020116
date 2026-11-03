<!DOCTYPE html>
<html>
<head>
    <title>Sistem Pasien Klinik Hewan</title>
</head>
<body>

    <h1>Sistem Pasien Klinik Hewan</h1>

    <!-- Pesan berhasil -->
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <!-- Form pencarian dan filter -->
    <form action="{{ route('pasien-hewan.index') }}" method="GET">
        <input type="text" name="search"
               placeholder="Cari kode, nama, atau nomor rekam"
               value="{{ request('search') }}">

        <select name="jenis_hewan_id">
            <option value="">Semua Jenis Hewan</option>
            @foreach($jenisHewan as $jenis)
                <option value="{{ $jenis->id }}"
                    {{ request('jenis_hewan_id') == $jenis->id ? 'selected' : '' }}>
                    {{ $jenis->nama_jenis }}
                </option>
            @endforeach
        </select>

        <button type="submit">Cari / Filter</button>
        <a href="{{ route('pasien-hewan.index') }}">Reset</a>
    </form>

    <hr>

    <!-- Form tambah pasien -->
    <h2>Tambah Pasien Hewan</h2>

    <form action="{{ route('pasien-hewan.store') }}" method="POST">
        @csrf

        <label>Kode Pasien:</label><br>
        <input type="text" name="kode_pasien" value="{{ old('kode_pasien') }}">
        @error('kode_pasien')
            <p>{{ $message }}</p>
        @enderror
        <br><br>

        <label>Nama Hewan:</label><br>
        <input type="text" name="nama_hewan" value="{{ old('nama_hewan') }}">
        @error('nama_hewan')
            <p>{{ $message }}</p>
        @enderror
        <br><br>

        <label>Nomor Rekam:</label><br>
        <input type="text" name="nomor_rekam" value="{{ old('nomor_rekam') }}">
        @error('nomor_rekam')
            <p>{{ $message }}</p>
        @enderror
        <br><br>

        <label>Usia (Tahun):</label><br>
        <input type="number" name="usia_tahun" value="{{ old('usia_tahun') }}">
        @error('usia_tahun')
            <p>{{ $message }}</p>
        @enderror
        <br><br>

        <label>Jenis Hewan:</label><br>
        <select name="jenis_hewan_id">
            <option value="">Pilih Jenis Hewan</option>
            @foreach($jenisHewan as $jenis)
                <option value="{{ $jenis->id }}">
                    {{ $jenis->nama_jenis }}
                </option>
            @endforeach
        </select>
        @error('jenis_hewan_id')
            <p>{{ $message }}</p>
        @enderror
        <br><br>

        <button type="submit">Tambah Pasien</button>
    </form>

    <hr>

    <!-- Tabel daftar pasien -->
    <h2>Daftar Pasien Hewan</h2>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Pasien</th>
                <th>Nama Hewan</th>
                <th>Nomor Rekam</th>
                <th>Usia</th>
                <th>Status Usia</th>
                <th>Jenis Hewan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($pasien as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->kode_pasien }}</td>
                    <td>{{ $data->nama_hewan }}</td>
                    <td>{{ $data->nomor_rekam }}</td>
                    <td>{{ $data->usia_tahun }} tahun</td>

                    <!-- Status usia menggunakan fungsi controller -->
                    <td>{{ $data->usia_tahun >= 3 ? 'Dewasa' : 'Muda' }}</td>

                    <td>{{ $data->jenisHewan->nama_jenis }}</td>

                    <td>
                        <a href="{{ route('pasien-hewan.edit', $data->id) }}">Edit</a>

                        <form action="{{ route('pasien-hewan.destroy', $data->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Yakin ingin menghapus pasien?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Belum ada data pasien.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
