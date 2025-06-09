<!DOCTYPE html>
<html>
<head>
    <title>Edit Pasien</title>
    <style>
        body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 40px auto;
    max-width: 700px;
    background-color: #f9f9f9;
    color: #333;
    line-height: 1.6;
}

h1 {
    text-align: center;
    color: #444;
    margin-bottom: 30px;
}

/* Form container */
form {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

/* Label styling */
label {
    font-weight: bold;
    display: block;
    margin-top: 15px;
    margin-bottom: 5px;
}

/* Input, select, file */
input[type="text"],
input[type="date"],
input[type="file"],
select {
    width: 100%;
    padding: 10px;
    margin-top: 2px;
    border-radius: 6px;
    border: 1px solid #ccc;
    box-sizing: border-box;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

input[type="text"]:focus,
input[type="date"]:focus,
input[type="file"]:focus,
select:focus {
    outline: none;
    border-color: #007BFF;
}

/* Radio buttons */
.radio-group {
    margin-top: 5px;
}

input[type="radio"] {
    margin-right: 5px;
    vertical-align: middle;
}

/* Button styling */
button {
    margin-top: 25px;
    padding: 12px 25px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1.1rem;
    font-weight: 600;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

/* Link */
a {
    display: inline-block;
    margin-top: 20px;
    color: #007BFF;
    text-decoration: none;
    font-weight: 500;
}

a:hover {
    text-decoration: underline;
}

/* Error message box */
.error-list {
    background-color: #ffe0e0;
    padding: 15px 20px;
    border-left: 5px solid #d9534f;
    border-radius: 6px;
    margin-bottom: 20px;
    color: #a94442;
}

.error-list ul {
    margin: 0;
    padding-left: 20px;
}

/* Thumbnail foto pasien */
img {
    margin-top: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    max-width: 120px;
    display: block;
}

/* Responsive tweak */
@media (max-width: 480px) {
    body {
        margin: 20px;
        max-width: 100%;
    }

    button {
        width: 100%;
    }
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

        <label>Provinsi:</label>
        <select id="provinsi" name="provinsi_id">
            <option value="">-- Pilih Provinsi --</option>
            @foreach ($provinsis as $provinsi)
                <option value="{{ $provinsi->id }}" {{ $provinsi->id == $pasien->desa->kecamatan->kota->provinsi_id ? 'selected' : '' }}>
                    {{ $provinsi->nama }}
                </option>
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

        <label>Foto Pasien (biarkan kosong jika tidak ingin diganti):</label>
        <input type="file" name="foto_pasien">

        @if ($pasien->foto_pasien)
            <img src="{{ asset('storage/' . $pasien->foto_pasien) }}" alt="Foto Pasien" width="100">
        @endif

        <button type="submit">Simpan Perubahan</button>
    </form>

    <a href="{{ route('pasien.index') }}">← Kembali ke daftar pasien</a>

    <script>
        const pasien = @json($pasien);

        const selectProvinsi = document.getElementById('provinsi');
        const selectKota     = document.getElementById('kota');
        const selectKecamatan= document.getElementById('kecamatan');
        const selectDesa     = document.getElementById('desa');

        function loadKota(provinsiId, selectedKotaId = null) {
            fetch(`/get-kotas/${provinsiId}`)
                .then(res => res.json())
                .then(data => {
                    selectKota.innerHTML = '<option value="">-- Pilih Kota --</option>';
                    data.forEach(kota => {
                        const selected = kota.id == selectedKotaId ? 'selected' : '';
                        selectKota.innerHTML += `<option value="${kota.id}" ${selected}>${kota.nama}</option>`;
                    });
                });
        }

        function loadKecamatan(kotaId, selectedKecamatanId = null) {
            fetch(`/get-kecamatans/${kotaId}`)
                .then(res => res.json())
                .then(data => {
                    selectKecamatan.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                    data.forEach(kecamatan => {
                        const selected = kecamatan.id == selectedKecamatanId ? 'selected' : '';
                        selectKecamatan.innerHTML += `<option value="${kecamatan.id}" ${selected}>${kecamatan.nama}</option>`;
                    });
                });
        }

        function loadDesa(kecamatanId, selectedDesaId = null) {
            fetch(`/get-desas/${kecamatanId}`)
                .then(res => res.json())
                .then(data => {
                    selectDesa.innerHTML = '<option value="">-- Pilih Desa --</option>';
                    data.forEach(desa => {
                        const selected = desa.id == selectedDesaId ? 'selected' : '';
                        selectDesa.innerHTML += `<option value="${desa.id}" ${selected}>${desa.nama}</option>`;
                    });
                });
        }

        selectProvinsi.addEventListener('change', function () {
            loadKota(this.value);
            selectKecamatan.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            selectDesa.innerHTML = '<option value="">-- Pilih Desa --</option>';
        });

        selectKota.addEventListener('change', function () {
            loadKecamatan(this.value);
            selectDesa.innerHTML = '<option value="">-- Pilih Desa --</option>';
        });

        selectKecamatan.addEventListener('change', function () {
            loadDesa(this.value);
        });

        // Saat halaman dibuka, auto-load data sesuai pasien
        document.addEventListener('DOMContentLoaded', function () {
            const provId = pasien.desa.kecamatan.kota.provinsi_id;
            const kotaId = pasien.desa.kecamatan.kota_id;
            const kecId  = pasien.desa.kecamatan_id;
            const desaId = pasien.desa_id;

            loadKota(provId, kotaId);
            loadKecamatan(kotaId, kecId);
            loadDesa(kecId, desaId);
        });
    </script>
</body>
</html>
