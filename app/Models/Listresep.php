<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listresep extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kategori',
        'id_bahan',
        'nama_listresep'
    ];
}
