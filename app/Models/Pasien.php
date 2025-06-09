<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasiens';

    protected $fillable = [
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan_id',
        'desa_id',
        'foto_pasien',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class);
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    public function riwayatPenyakits()
    {
        return $this->hasMany(RiwayatPenyakit::class);
    }
}