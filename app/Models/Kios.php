<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kios extends Model
{
    use HasFactory;

    protected $table = 'kios';

    protected $fillable = [
        'pedagang_id',
        'nama',
    ];

    public function pedagang()
    {
        return $this->belongsTo(Pedagang::class, 'pedagang_id');
    }
}
