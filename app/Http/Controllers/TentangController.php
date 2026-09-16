<?php

namespace App\Http\Controllers;

use App\Models\InformasiToko;
use Illuminate\Http\Request;

class TentangController extends Controller
{
    private function informasiToko(): InformasiToko
    {
        return InformasiToko::firstOrCreate(['id' => 1], ['nama_toko' => 'K5 Mart']);
    }

    public function index()
    {
        return view('tentang.index', ['toko' => $this->informasiToko()]);
    }

    public function edit()
    {
        return view('tentang.edit', ['toko' => $this->informasiToko()]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_toko' => ['required', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string', 'max:10000'],
            'sejarah' => ['nullable', 'string', 'max:10000'],
            'visi' => ['nullable', 'string', 'max:10000'],
            'misi' => ['nullable', 'string', 'max:10000'],
            'produk_layanan' => ['nullable', 'string', 'max:10000'],
            'alamat' => ['nullable', 'string', 'max:2000'],
            'telepon' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
        ]);

        $this->informasiToko()->update($validated);

        return redirect()->route('tentang.index')
            ->with('success', 'Informasi toko berhasil diperbarui.');
    }
}
