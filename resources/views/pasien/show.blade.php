<!DOCTYPE html>
<html>
<head>
    <title>Detail Pasien</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 700px;
            margin: 40px auto;
            background-color: #f8f9fa;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #444;
            margin-bottom: 30px;
        }

        .card {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        p {
            font-size: 16px;
            margin-bottom: 12px;
        }

        strong {
            display: inline-block;
            width: 200px;
            color: #555;
        }

        img {
            margin-top: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
        }

        .action-buttons {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <h1>Detail Pasien</h1>

    <div class="card">
        <p><strong>Nama:</strong> {{ $pasien->nama }}</p>
        <p><strong>NIK:</strong> {{ $pasien->nik }}</p>
        <p><strong>Tempat, Tanggal Lahir:</strong>
            {{ $pasien->tempat_lahir ?? '-' }}, 
            {{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('d-m-Y') }}
        </p>
        <p><strong>Jenis Kelamin:</strong> {{ $pasien->jenis_kelamin }}</p>
        <p><strong>Pekerjaan:</strong> {{ $pasien->pekerjaan->nama }}</p>
        <p><strong>Alamat:</strong>
            {{ $pasien->desa->nama }},
            {{ $pasien->desa->kecamatan->nama }},
            {{ $pasien->desa->kecamatan->kota->nama }},
            {{ $pasien->desa->kecamatan->kota->provinsi->nama }}
        </p>
        <p><strong>Foto:</strong><br>
            @if ($pasien->foto_pasien)
                <img src="{{ asset('storage/' . $pasien->foto_pasien) }}" alt="Foto Pasien" width="150">
            @else
                Tidak ada foto.
            @endif
        </p>

        <div class="action-buttons">
            <a href="{{ route('pasien.edit', $pasien->id) }}">✏️ Edit Data Pasien</a><br>
            <a href="{{ route('pasien.index') }}">← Kembali ke daftar pasien</a>
        </div>
    </div>
</body>
</html>