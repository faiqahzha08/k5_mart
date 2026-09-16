<?php

namespace Database\Factories;

use App\Models\Produk;
use App\Models\User;
use App\Models\JenisProduk;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    protected $model = Produk::class;

    public function definition(): array
    {
        $produk = [
            ['Es Teh', 'Minuman'],
            ['Es Jeruk', 'Minuman'],
            ['Jus Mangga', 'Minuman'],
            ['Jus Alpukat', 'Minuman'],
            ['Kopi Hitam', 'Minuman'],
            ['Kopi Susu', 'Minuman'],
            ['Cappuccino', 'Minuman'],
            ['Matcha Latte', 'Minuman'],
            ['Thai Tea', 'Minuman'],
            ['Boba Brown Sugar', 'Minuman'],

            ['Nasi Goreng', 'Makanan'],
            ['Mie Goreng', 'Makanan'],
            ['Bakso', 'Makanan'],
            ['Soto Ayam', 'Makanan'],
            ['Ayam Geprek', 'Makanan'],
            ['Ayam Bakar', 'Makanan'],
            ['Mie Ayam', 'Makanan'],
            ['Martabak', 'Makanan'],
            ['Roti Bakar', 'Makanan'],
            ['Seblak', 'Makanan'],
        ];

        $item = $this->faker->randomElement($produk);

        $hargaBeli = $this->faker->numberBetween(10000, 50000);

        return [
            'user_id' => User::where('role_id', 1)->inRandomOrder()->value('id'),
            'foto' => null,
            'nama' => $item[0],
            'jenis_produk_id' => JenisProduk::inRandomOrder()->value('id'),
            'harga_beli' => $hargaBeli,
            'harga_jual' => $hargaBeli + $this->faker->numberBetween(5000, 15000),
            'stok' => $this->faker->numberBetween(10, 200),
        ];
    }
}
