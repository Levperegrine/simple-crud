<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NomorAsuransi extends Model
{
    use HasFactory;

    protected $table = 'nomor_asuransis';

    protected $fillable = ['nomor', 'jenis_asuransi_id'];

    public function jenisAsuransi()
    {
        return $this->belongsTo(JenisAsuransi::class);
    }
}