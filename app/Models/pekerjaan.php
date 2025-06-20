<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pekerjaan extends Model
{
    use HasFactory;

    protected $table = 'pekerjaans';

    protected $fillable = ['nama'];

    public function pasiens()
    {
        return $this->hasMany(Pasien::class);
    }
}