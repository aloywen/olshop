<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama_produk', 'deskripsi', 'harga', 'stok', 'gambar', 'kategori'];

}
