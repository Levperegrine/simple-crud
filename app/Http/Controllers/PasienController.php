<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Models\Pekerjaan;
use \App\Models\Provinsi;
use Illuminate\Support\Facades\Storage;

class PasienController extends Controller
{
    // Tampilkan semua data pasien
    public function index()
    {
        $pasiens = Pasien::with(['pekerjaan', 'desa.kecamatan.kota.provinsi'])->get();
        return view('pasien.index', compact('pasiens'));
    }

    // Form tambah pasien (jika diperlukan nantinya)
    public function create()
    {
        $pekerjaans = Pekerjaan::all();
        $provinsis = Provinsi::all();
        return view('pasien.create', compact('pekerjaans', 'provinsis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'nama' => 'required|string',
        'nik' => 'required|string|digits:16|unique:pasiens,nik',
        'tempat_lahir' => 'nullable|string',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'pekerjaan_id' => 'required|exists:pekerjaans,id',
        'desa_id' => 'required|exists:desas,id',
        'foto_pasien' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('foto_pasien')) {
        $validated['foto_pasien'] = $request->file('foto_pasien')->store('foto_pasien', 'public');
    }

    Pasien::create($validated);

    return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    public function show(Pasien $pasien)
    {
        $pasien->load(['pekerjaan', 'desa.kecamatan.kota.provinsi']);
        return view('pasien.show', compact('pasien'));
    }

    public function edit(Pasien $pasien)
    {
        $pasien->load('desa.kecamatan.kota.provinsi');
        $pekerjaans = Pekerjaan::all();
        $provinsis = Provinsi::all();

        return view('pasien.edit', compact('pasien', 'pekerjaans', 'provinsis'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $validated = $request->validate([
        'nama' => 'required|string',
        'nik' => 'required|string|digits:16|unique:pasiens,nik,' . $pasien->id,
        'tempat_lahir' => 'nullable|string',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'pekerjaan_id' => 'required|exists:pekerjaans,id',
        'desa_id' => 'required|exists:desas,id',
        'foto_pasien' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('foto_pasien')) {
        $validated['foto_pasien'] = $request->file('foto_pasien')->store('foto_pasien', 'public');
    }

    if ($request->hasFile('foto_pasien')) {
        // Hapus foto lama jika ada
        if ($pasien->foto_pasien) {
            Storage::disk('public')->delete($pasien->foto_pasien);
        }

        $validated['foto_pasien'] = $request->file('foto_pasien')->store('foto_pasien', 'public');
    }
    $pasien->update($validated);

    return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy(Pasien $pasien)
    {
        if ($pasien->foto_pasien) {
        Storage::disk('public')->delete($pasien->foto_pasien);
        }

        $pasien->delete();

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus.');
    }
}