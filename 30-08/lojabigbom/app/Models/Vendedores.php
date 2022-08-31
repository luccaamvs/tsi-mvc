<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendedores extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'matricula',
        'nome'
    ];
    protected $table = 'vendedores';
}
