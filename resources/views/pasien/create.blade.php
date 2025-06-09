<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pasien</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 40px auto;
            max-width: 700px;
            background-color: #f9f9f9;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #444;
            margin-bottom: 30px;
        }

        form {
            background-color: white;
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

        input[type="radio"] {
            margin-right: 5px;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
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
            padding: 10px 20px;
            border-left: 5px solid red;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .error-list ul {
            margin: 0;
            padding-left: 20px;
        }

        .radio-group {
            margin-top: 5px;
        }

    </style>
</head>
<body>
    <h1>Tambah Data Pasien</h1>

    @if ($errors->any())
        <div class="error-list">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pasien.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Nama:</label>
        <input type="text" name="nama" value="{{ old('nama') }}">

        <label>NIK:</label>
        <input type="text" name="nik" value="{{ old('nik') }}">

        <label>Tempat Lahir:</label>
        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}">

        <label>Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">

        <label>Jenis Kelamin:</label>
        <div class="radio-group">
            <input type="radio" name="jenis_kelamin" value="Laki-laki"
                {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }}> Laki-laki
            <input type="radio" name="jenis_kelamin" value="Perempuan"
                {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}> Perempuan
        </div>

        <label>Pekerjaan:</label>
        <select name="pekerjaan_id">
            @foreach ($pekerjaans as $pekerjaan)
                <option value="{{ $pekerjaan->id }}" {{ old('pekerjaan_id') == $pekerjaan->id ? 'selected' : '' }}>
                    {{ $pekerjaan->nama }}
                </option>
            @endforeach
        </select>

        <label>Alamat:</label>
        <label>Provinsi:</label>
        <select id="provinsi" name="provinsi_id">
            <option value="">-- Pilih Provinsi --</option>
            @foreach ($provinsis as $provinsi)
                <option value="{{ $provinsi->id }}">{{ $provinsi->nama }}</option>
            @endforeach
        </select>

        <label>Kota:</label>
        <select id="kota" name="kota_id">
            <option value="">-- Pilih Kota --</option>
        </select>

        <label>Kecamatan:</label>
        <select id="kecamatan" name="kecamatan_id">
            <option value="">-- Pilih Kecamatan --</option>
        </select>

        <label>Desa:</label>
        <select id="desa" name="desa_id">
            <option value="">-- Pilih Desa --</option>
        </select>

        <label>Foto Pasien:</label>
        <input type="file" name="foto_pasien">

        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('pasien.index') }}">← Kembali ke daftar pasien</a>

    <script>
        document.getElementById('provinsi').addEventListener('change', function () {
            const provinsiId = this.value;
            fetch('/get-kotas/' + provinsiId)
                .then(response => response.json())
                .then(data => {
                    let kotaOptions = '<option value="">-- Pilih Kota --</option>';
                    data.forEach(kota => {
                        kotaOptions += `<option value="${kota.id}">${kota.nama}</option>`;
                    });
                    document.getElementById('kota').innerHTML = kotaOptions;
                    document.getElementById('kecamatan').innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                    document.getElementById('desa').innerHTML = '<option value="">-- Pilih Desa --</option>';
                });
        });

        document.getElementById('kota').addEventListener('change', function () {
            const kotaId = this.value;
            fetch('/get-kecamatans/' + kotaId)
                .then(response => response.json())
                .then(data => {
                    let kecamatanOptions = '<option value="">-- Pilih Kecamatan --</option>';
                    data.forEach(kecamatan => {
                        kecamatanOptions += `<option value="${kecamatan.id}">${kecamatan.nama}</option>`;
                    });
                    document.getElementById('kecamatan').innerHTML = kecamatanOptions;
                    document.getElementById('desa').innerHTML = '<option value="">-- Pilih Desa --</option>';
                });
        });

        document.getElementById('kecamatan').addEventListener('change', function () {
            const kecamatanId = this.value;
            fetch('/get-desas/' + kecamatanId)
                .then(response => response.json())
                .then(data => {
                    let desaOptions = '<option value="">-- Pilih Desa --</option>';
                    data.forEach(desa => {
                        desaOptions += `<option value="${desa.id}">${desa.nama}</option>`;
                    });
                    document.getElementById('desa').innerHTML = desaOptions;
                });
        });
    </script>

</body>
</html>
