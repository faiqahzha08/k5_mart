<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiToko extends Model
{
    protected $table = 'informasi_toko';

    protected $fillable = [
        'id', 'nama_toko', 'tagline', 'deskripsi', 'sejarah', 'visi', 'misi',
        'produk_layanan', 'alamat', 'telepon', 'email',
    ];
}
