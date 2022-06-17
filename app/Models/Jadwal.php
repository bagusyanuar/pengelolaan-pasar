<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $fillable = [
        'tanggal',
        'mulai',
        'selesai'
    ];

    public function jadwal_pegawai()
    {
        return $this->hasMany(JadwalPegawai::class, 'jadwal_id');
    }
}
