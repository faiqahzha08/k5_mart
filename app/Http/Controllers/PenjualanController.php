<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\ItemPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Menampilkan data penjualan
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Ubah transaksi OPEN menjadi COMPLETED
        |--------------------------------------------------------------------------
        | Transaksi yang sudah tersimpan sebelumnya dengan status OPEN
        | akan otomatis menjadi COMPLETED.
        */

        Penjualan::where('status', 'OPEN')
            ->orWhere('status', 'open')
            ->update([
                'status' => 'COMPLETED'
            ]);


        /*
        |--------------------------------------------------------------------------
        | Ambil data penjualan
        |--------------------------------------------------------------------------
        */

        $penjualans = Penjualan::with('user')
            ->latest()
            ->paginate(10);


        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $totalTransaksi = Penjualan::count();

        $totalOmzet = Penjualan::sum('total_pembayaran');

        $hariIni = Penjualan::whereDate(
            'created_at',
            today()
        )->count();


        return view(
            'penjualan.index',
            compact(
                'penjualans',
                'totalTransaksi',
                'totalOmzet',
                'hariIni'
            )
        );
    }


    /**
     * Menampilkan halaman transaksi baru
     */
    public function create()
    {
        $produks = Produk::where('stok', '>', 0)
            ->orderBy('nama')
            ->get();

        return view(
            'penjualan.create',
            compact('produks')
        );
    }


    /**
     * Menyimpan transaksi baru
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'produk_id' => [
                'required',
                'array',
                'min:1'
            ],

            'produk_id.*' => [
                'required',
                'exists:produk,id'
            ],

            'qty' => [
                'required',
                'array',
                'min:1'
            ],

            'qty.*' => [
                'required',
                'integer',
                'min:1'
            ],

            'metode_pembayaran' => [
                'required',
                'in:cash,transfer,qris'
            ],

            'uang_dibayar' => [
                'nullable',
                'numeric',
                'min:0'
            ],
        ]);


        DB::beginTransaction();


        try {

            $total = 0;

            $items = [];


            /*
            |--------------------------------------------------------------------------
            | HITUNG TOTAL
            |--------------------------------------------------------------------------
            */

            foreach ($request->produk_id as $i => $produkId) {

                $produk = Produk::findOrFail($produkId);

                $qty = (int) $request->qty[$i];


                /*
                | Cek stok
                */

                if ($produk->stok < $qty) {

                    throw new \Exception(
                        "Stok {$produk->nama} tidak cukup. " .
                        "Stok tersedia: {$produk->stok}"
                    );
                }


                /*
                | Gunakan harga jual
                */

                $harga = (float) $produk->harga_jual;


                /*
                | Hitung subtotal
                */

                $subtotal = $harga * $qty;


                $total += $subtotal;


                $items[] = [
                    'produk' => $produk,
                    'qty' => $qty,
                    'harga' => $harga,
                    'subtotal' => $subtotal,
                ];
            }

            $metodePembayaran = strtolower($request->metode_pembayaran);
            $uangDibayar = null;
            $kembalian = null;

            if ($metodePembayaran === 'cash') {
                $uangDibayar = (float) $request->uang_dibayar;

                if ($uangDibayar < $total) {
                    throw new \Exception('Uang dibayar kurang dari total pembayaran.');
                }

                $kembalian = $uangDibayar - $total;
            }


            /*
            |--------------------------------------------------------------------------
            | SIMPAN PENJUALAN
            |--------------------------------------------------------------------------
            */

            $penjualan = Penjualan::create([
                'user_id' => auth()->id(),

                'total_pembayaran' => $total,

                'metode_pembayaran' =>
                    $metodePembayaran,

                'uang_dibayar' => $uangDibayar,

                'kembalian' => $kembalian,

                /*
                | Transaksi baru langsung Completed
                */

                'status' => 'COMPLETED',
            ]);


            /*
            |--------------------------------------------------------------------------
            | SIMPAN ITEM
            |--------------------------------------------------------------------------
            */

            foreach ($items as $item) {

                ItemPenjualan::create([
                    'penjualan_id' =>
                        $penjualan->id,

                    'produk_id' =>
                        $item['produk']->id,

                    'kuantitas' =>
                        $item['qty'],

                    'harga_satuan' =>
                        $item['harga'],

                    'subtotal' =>
                        $item['subtotal'],
                ]);


                /*
                | Kurangi stok
                */

                $item['produk']->decrement(
                    'stok',
                    $item['qty']
                );
            }


            DB::commit();


            return redirect()
                ->route('penjualan.index')
                ->with(
                    'success',
                    'Transaksi berhasil disimpan dan berstatus Completed.'
                );

        } catch (\Exception $e) {

            DB::rollBack();


            return back()
                ->with(
                    'error',
                    $e->getMessage()
                )
                ->withInput();
        }
    }


    /**
     * Detail transaksi
     */
    public function show($id)
    {
        $penjualan = Penjualan::with([
            'user',
            'itemPenjualan.produk'
        ])->findOrFail($id);


        return view(
            'penjualan.show',
            compact('penjualan')
        );
    }


    /**
     * Hapus transaksi
     */
    public function destroy($id)
    {
        $penjualan = Penjualan::with(
            'itemPenjualan'
        )->findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | Transaksi Completed tidak boleh dihapus
        |--------------------------------------------------------------------------
        */

        if (strtoupper($penjualan->status) === 'COMPLETED') {

            return redirect()
                ->route('penjualan.index')
                ->with(
                    'error',
                    'Transaksi yang sudah Completed tidak dapat dihapus.'
                );
        }


        DB::beginTransaction();


        try {

            /*
            |--------------------------------------------------------------------------
            | Kembalikan stok
            |--------------------------------------------------------------------------
            */

            foreach (
                $penjualan->itemPenjualan as $detail
            ) {

                Produk::where(
                    'id',
                    $detail->produk_id
                )->increment(
                    'stok',
                    $detail->kuantitas
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Hapus item
            |--------------------------------------------------------------------------
            */

            $penjualan
                ->itemPenjualan()
                ->delete();


            /*
            |--------------------------------------------------------------------------
            | Hapus transaksi
            |--------------------------------------------------------------------------
            */

            $penjualan->delete();


            DB::commit();


            return redirect()
                ->route('penjualan.index')
                ->with(
                    'success',
                    'Transaksi berhasil dihapus.'
                );

        } catch (\Exception $e) {

            DB::rollBack();


            return back()
                ->with(
                    'error',
                    'Gagal menghapus transaksi: ' .
                    $e->getMessage()
                );
        }
    }
}
