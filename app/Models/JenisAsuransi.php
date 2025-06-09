<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisAsuransi extends Model
{
    use HasFactory;

    protected $table = 'jenis_asuransis';

    protected $fillable = ['nama'];

    public function nomorAsuransis()
    {
        return $this->hasMany(NomorAsuransi::class);
    }
}