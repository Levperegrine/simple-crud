<!DOCTYPE html>
<html>
<head>
    <title>Edit Pasien</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 40px auto;
            max-width: 700px;
            background-color: #f5f5f5;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #444;
            margin-bottom: 30px;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        input[type="text"],
        input[type="date"],
        input[type="file"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .radio-group {
            margin-top: 5px;
        }

        input[type="radio"] {
            margin-right: 6px;
            margin-top: 8px;
        }

        button {
            margin-top: 25px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #218838;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .error-list {
            background-color: #ffe0e0;
            padding: 15px 20px;
            border-left: 5px solid red;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .error-list ul {
            margin: 0;
            padding-left: 20px;
        }

        img {
            margin-top: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

    </style>
</head>
<body>
    <h1>Edit Data Pasien</h1>

    @if ($errors->any())
        <div class="error-list">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pasien.update', $pasien->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Nama:</label>
        <input type="text" name="nama" value="{{ old('nama', $pasien->nama) }}">

        <label>NIK:</label>
        <input type="text" name="nik" value="{{ old('nik', $pasien->nik) }}">

        <label>Tempat Lahir:</label>
        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $pasien->tempat_lahir) }}">

        <label>Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pasien->tanggal_lahir) }}">

        <label>Jenis Kelamin:</label>
        <div class="radio-group">
            <input type="radio" name="jenis_kelamin" value="Laki-laki"
                {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'Laki-laki' ? 'checked' : '' }}> Laki-laki
            <input type="radio" name="jenis_kelamin" value="Perempuan"
                {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'Perempuan' ? 'checked' : '' }}> Perempuan
        </div>

        <label>Pekerjaan:</label>
        <select name="pekerjaan_id">
            @foreach ($pekerjaans as $pekerjaan)
                <option value="{{ $pekerjaan->id }}" {{ $pekerjaan->id == old('pekerjaan_id', $pasien->pekerjaan_id) ? 'selected' : '' }}>
                    {{ $pekerjaan->nama }}
                </option>
            @endforeach
        </select>

        <label>Alamat (Desa):</label>
        <select name="desa_id">
            @foreach ($desas as $desa)
                <option value="{{ $desa->id }}" {{ $desa->id == old('desa_id', $pasien->desa_id) ? 'selected' : '' }}>
                    {{ $desa->nama }},
                    {{ $desa->kecamatan->nama }},
                    {{ $desa->kecamatan->kota->nama }},
                    {{ $desa->kecamatan->kota->provinsi->nama }}
                </option>
            @endforeach
        </select>

        <label>Foto Pasien (biarkan kosong jika tidak ingin diganti):</label>
        <input type="file" name="foto_pasien">

        @if ($pasien->foto_pasien)
            <img src="{{ asset('storage/' . $pasien->foto_pasien) }}" alt="Foto Pasien" width="100">
        @endif

        <button type="submit">Simpan Perubahan</button>
    </form>

    <a href="{{ route('pasien.index') }}">← Kembali ke daftar pasien</a>
</body>
</html>