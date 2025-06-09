<!DOCTYPE html>
<html>
<head>
    <title>Data Pasien</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 40px;
        background-color: #f9f9f9;
        color: #333;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #444;
    }

    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .top-bar a.button-add {
        background-color: #28a745;
        color: white;
        padding: 10px 16px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.2s;
    }

    .top-bar a.button-add:hover {
        background-color: #218838;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        background-color: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    th, td {
        padding: 12px 16px;
        text-align: left;
    }

    th {
        background-color: #007BFF;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #e0f3ff;
    }

    a {
        color: #007BFF;
        text-decoration: none;
        margin-right: 8px;
    }

    a:hover {
        text-decoration: underline;
    }

    button {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #c82333;
    }

    img {
        border-radius: 6px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.2);
    }

    form {
        display: inline;
    }
    </style>
</head>
<body>
    <h1>Daftar Pasien</h1>

    <div class="top-bar">
        <div></div> <!-- Kosong untuk menyelaraskan tombol di kanan -->
        <a href="{{ route('pasien.create') }}" class="button-add">➕ Tambah Pasien Baru</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIK</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Pekerjaan</th>
                <th>Alamat</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pasiens as $pasien)
                <tr>
                    <td>{{ $pasien->nama }}</td>
                    <td>{{ $pasien->nik }}</td>
                    <td>{{ $pasien->tempat_lahir ?? '-' }}, {{ $pasien->tanggal_lahir->format('d-m-Y') }}</td>
                    <td>{{ $pasien->jenis_kelamin }}</td>
                    <td>{{ $pasien->pekerjaan->nama }}</td>
                    <td>
                        {{ $pasien->desa->nama }},
                        {{ $pasien->desa->kecamatan->nama }},
                        {{ $pasien->desa->kecamatan->kota->nama }},
                        {{ $pasien->desa->kecamatan->kota->provinsi->nama }}
                    </td>
                    <td>
                        @if ($pasien->foto_pasien)
                            <img src="{{ asset('storage/' . $pasien->foto_pasien) }}" alt="Foto Pasien" width="60">
                        @else
                            Tidak ada
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('pasien.show', $pasien->id) }}">Lihat</a>
                        <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">🗑 Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>