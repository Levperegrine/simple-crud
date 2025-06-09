<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatPenyakit extends Model
{
    use HasFactory;

    protected $table = 'riwayat_penyakits';

    protected $fillable = [
        'pasien_id',
        'penyakit',
        'tanggal_diagnosa',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}