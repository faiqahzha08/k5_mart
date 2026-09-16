<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\ItemPenjualan;
use App\Models\JenisProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::with('jenisProduk');

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->stok == 'aman') {
            $query->where('stok', '>=', 10);
        }

        if ($request->stok == 'rendah') {
            $query->whereBetween('stok', [1, 9]);
        }

        if ($request->stok == 'habis') {
            $query->where('stok', 0);
        }

        $produks = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('produk.index', compact('produks'));
    }


    public function create()
    {
        $jenisProduks = JenisProduk::orderBy('nama')->get();

        return view('produk.create', compact('jenisProduks'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',

            'jenis_produk_id' => [
                'required',
                'exists:jenis_produks,id'
            ],

            'harga_beli' => 'required|numeric|min:0',

            'harga_jual' => 'required|numeric|min:0',

            'stok' => 'required|integer|min:0',

            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        $foto = null;

        if ($request->hasFile('foto')) {
            $foto = $request
                ->file('foto')
                ->store('produk', 'public');
        }


        Produk::create([
            'user_id' => Auth::id(),

            'foto' => $foto,

            'nama' => $validated['nama'],

            'jenis_produk_id' => $validated['jenis_produk_id'],

            'harga_beli' => $validated['harga_beli'],

            'harga_jual' => $validated['harga_jual'],

            'stok' => $validated['stok'],
        ]);


        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }


    public function show($id)
    {
        $produk = Produk::with('jenisProduk')->findOrFail($id);

        return view('produk.show', compact('produk'));
    }


    public function edit($id)
    {
        $produk = Produk::findOrFail($id);

        $jenisProduks = JenisProduk::orderBy('nama')->get();

        return view('produk.edit', compact('produk', 'jenisProduks'));
    }


    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);


        $validated = $request->validate([
            'nama' => 'required|string|max:255',

            'jenis_produk_id' => [
                'required',
                'exists:jenis_produks,id'
            ],

            'harga_beli' => 'required|numeric|min:0',

            'harga_jual' => 'required|numeric|min:0',

            'stok' => 'required|integer|min:0',

            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        $foto = $produk->foto;


        if ($request->hasFile('foto')) {

            if (
                $produk->foto &&
                Storage::disk('public')->exists($produk->foto)
            ) {
                Storage::disk('public')->delete($produk->foto);
            }

            $foto = $request
                ->file('foto')
                ->store('produk', 'public');
        }


        $produk->update([
            'foto' => $foto,

            'nama' => $validated['nama'],

            'jenis_produk_id' => $validated['jenis_produk_id'],

            'harga_beli' => $validated['harga_beli'],

            'harga_jual' => $validated['harga_jual'],

            'stok' => $validated['stok'],
        ]);


        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil diupdate.');
    }


    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);


        if (
            ItemPenjualan::where(
                'produk_id',
                $produk->id
            )->exists()
        ) {

            return redirect()
                ->route('produk.index')
                ->with(
                    'error',
                    'Produk tidak dapat dihapus karena sudah digunakan pada transaksi.'
                );
        }


        if (
            $produk->foto &&
            Storage::disk('public')->exists($produk->foto)
        ) {

            Storage::disk('public')->delete(
                $produk->foto
            );
        }


        $produk->delete();


        return redirect()
            ->route('produk.index')
            ->with(
                'success',
                'Produk berhasil dihapus.'
            );
    }
}
