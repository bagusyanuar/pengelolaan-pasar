<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    use HasFactory;

    protected $table = 'keluhan';

    protected $fillable = [
        'pedagang_id',
        'deskripsi',
        'tanggal',
        'status',
    ];

    public function pedagang()
    {
        return $this->belongsTo(Pedagang::class, 'pedagang_id');
    }
}
