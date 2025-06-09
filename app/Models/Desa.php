<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'desas';

    protected $fillable = ['nama', 'kecamatan_id'];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function pasiens()
    {
        return $this->hasMany(Pasien::class);
    }
}