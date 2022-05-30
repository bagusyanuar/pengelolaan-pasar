<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sarana extends Model
{
    use HasFactory;

    protected $table = 'sarana';

    protected $fillable = [
        'nama',
        'qty',
    ];
}
