<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisProduk extends Model
{
    protected $table = 'jenis_produks';

    protected $fillable = [
        'nama',
    ];


    public function produks()
    {
        return $this->hasMany(
            Produk::class,
            'jenis_produk_id'
        );
    }
}