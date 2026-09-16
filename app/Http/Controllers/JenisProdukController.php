<?php

namespace App\Http\Controllers;

use App\Models\JenisProduk;
use Illuminate\Http\Request;

class JenisProdukController extends Controller
{
    public function index()
    {
        $jenisProduks = JenisProduk::withCount('produks')
            ->latest()
            ->get();

        return view('jenis_produk.index', compact('jenisProduks'));
    }


    public function create()
    {
        return view('jenis_produk.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:jenis_produks,nama',
        ], [
            'nama.required' => 'Nama jenis produk wajib diisi.',
            'nama.unique' => 'Jenis produk tersebut sudah ada.',
        ]);

        JenisProduk::create([
            'nama' => $validated['nama'],
        ]);

        return redirect()
            ->route('jenis-produk.index')
            ->with('success', 'Jenis produk berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $jenisProduk = JenisProduk::findOrFail($id);

        return view('jenis_produk.edit', compact('jenisProduk'));
    }


    public function update(Request $request, $id)
    {
        $jenisProduk = JenisProduk::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:jenis_produks,nama,' . $jenisProduk->id,
        ], [
            'nama.required' => 'Nama jenis produk wajib diisi.',
            'nama.unique' => 'Jenis produk tersebut sudah ada.',
        ]);

        $jenisProduk->update([
            'nama' => $validated['nama'],
        ]);

        return redirect()
            ->route('jenis-produk.index')
            ->with('success', 'Jenis produk berhasil diupdate.');
    }


    public function destroy($id)
    {
        $jenisProduk = JenisProduk::findOrFail($id);

        if ($jenisProduk->produks()->exists()) {

            return redirect()
                ->route('jenis-produk.index')
                ->with(
                    'error',
                    'Jenis produk tidak dapat dihapus karena masih digunakan oleh produk.'
                );
        }

        $jenisProduk->delete();

        return redirect()
            ->route('jenis-produk.index')
            ->with('success', 'Jenis produk berhasil dihapus.');
    }
}