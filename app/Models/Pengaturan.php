<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $fillable = ['nama_web', 'alamat', 'no_hp', 'logo', 'warna_web', 'tentang', 'tentang2', 'tentang3'];
    use HasFactory;
}
