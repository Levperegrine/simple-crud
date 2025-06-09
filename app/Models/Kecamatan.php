<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatans';

    protected $fillable = ['nama', 'kota_id'];

    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    public function desas()
    {
        return $this->hasMany(Desa::class);
    }
}
