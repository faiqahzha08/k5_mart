<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'user_id',
        'foto',
        'nama',
        'jenis_produk_id',
        'harga_beli',
        'harga_jual',
        'stok',
    ];


    public function jenisProduk()
    {
        return $this->belongsTo(
            JenisProduk::class,
            'jenis_produk_id'
        );
    }


    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}
