<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prime extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_',
        'police',
        'nom',
        'retard',
        'contact',
    ];
}
