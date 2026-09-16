@extends('layouts.app')

@section('title', 'Detail Transaksi - K5 Mart')

@section('content')

<div class="mb-8">

    {{-- Tombol Kembali --}}
    <a href="{{ route('penjualan.index') }}"
       class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-indigo-600 transition mb-4">

        <i data-lucide="arrow-left" class="w-4 h-4"></i>

        Kembali

    </a>

    {{-- Judul --}}
    <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
        Detail Transaksi
    </h1>

    <p class="mt-1 text-sm text-slate-500">
        {{ $penjualan->kode ?? '#' . $penjualan->id }}
    </p>

</div>


<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- ===================================================== --}}
    {{-- ITEM TRANSAKSI --}}
    {{-- ===================================================== --}}

    <div class="lg:col-span-2">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

            {{-- Header --}}
            <div class="px-5 py-4 border-b border-slate-100">

                <div class="flex items-center justify-between gap-4">

                    <div>

                        <h3 class="font-semibold text-slate-800">
                            Item Transaksi
                        </h3>

                        <p class="text-xs text-slate-500 mt-1">
                            Daftar produk yang dibeli
                        </p>

                    </div>


                    {{-- Status --}}
                    @if(strtolower($penjualan->status ?? '') === 'completed')

                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-600 text-xs font-semibold">

                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                            Completed

                        </span>

                    @else

                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-50 text-amber-600 text-xs font-semibold">

                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>

                            {{ ucfirst($penjualan->status ?? 'Open') }}

                        </span>

                    @endif

                </div>

            </div>


            {{-- Tabel Item --}}
            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead>

                        <tr class="bg-slate-50 border-b border-slate-100">

                            <th class="text-left px-5 py-3 font-semibold text-slate-600">
                                Produk
                            </th>

                            <th class="text-center px-5 py-3 font-semibold text-slate-600">
                                Qty
                            </th>

                            <th class="text-right px-5 py-3 font-semibold text-slate-600">
                                Harga
                            </th>

                            <th class="text-right px-5 py-3 font-semibold text-slate-600">
                                Subtotal
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse($penjualan->itemPenjualan as $detail)

                            <tr class="hover:bg-slate-50 transition">

                                {{-- Produk --}}
                                <td class="px-5 py-4">

                                    <div class="font-medium text-slate-800">

                                        {{ $detail->produk->nama ?? '-' }}

                                    </div>

                                </td>


                                {{-- Qty --}}
                                <td class="px-5 py-4 text-center text-slate-600">

                                    {{ $detail->kuantitas ?? 0 }}

                                </td>


                                {{-- Harga --}}
                                <td class="px-5 py-4 text-right text-slate-600">

                                    Rp
                                    {{ number_format(
                                        $detail->harga_satuan ?? 0,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </td>


                                {{-- Subtotal --}}
                                <td class="px-5 py-4 text-right font-semibold text-slate-800">

                                    Rp
                                    {{ number_format(
                                        $detail->subtotal ?? 0,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="px-5 py-10 text-center">

                                    <div class="flex flex-col items-center">

                                        <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center mb-3">

                                            <i data-lucide="receipt"
                                               class="w-6 h-6 text-slate-400">
                                            </i>

                                        </div>

                                        <p class="font-medium text-slate-700">
                                            Tidak ada item transaksi
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>


                    {{-- Total --}}
                    <tfoot>

                        <tr class="border-t border-slate-200 bg-slate-50">

                            <td colspan="3"
                                class="px-5 py-4 text-right font-semibold text-slate-800">

                                Total Pembayaran

                            </td>

                            <td class="px-5 py-4 text-right font-bold text-indigo-600 text-lg">

                                Rp
                                {{ number_format(
                                    $penjualan->total_pembayaran ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </td>

                        </tr>

                    </tfoot>

                </table>

            </div>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- INFORMASI TRANSAKSI --}}
    {{-- ===================================================== --}}

    <div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

            <h3 class="font-semibold text-slate-800 mb-5">
                Informasi Transaksi
            </h3>


            <div class="space-y-4 text-sm">


                {{-- Nomor Transaksi --}}
                <div>

                    <p class="text-slate-500 mb-1">
                        No. Transaksi
                    </p>

                    <p class="font-semibold text-slate-800">

                        {{ $penjualan->kode ?? '#' . $penjualan->id }}

                    </p>

                </div>


                {{-- Tanggal --}}
                <div>

                    <p class="text-slate-500 mb-1">
                        Tanggal
                    </p>

                    <p class="font-medium text-slate-800">

                        {{ $penjualan->created_at
                            ? $penjualan->created_at->format('d M Y H:i')
                            : '-'
                        }}

                    </p>

                </div>


                {{-- Kasir --}}
                <div>

                    <p class="text-slate-500 mb-1">
                        Kasir
                    </p>

                    <p class="font-medium text-slate-800">

                        {{ $penjualan->user->name ?? '-' }}

                    </p>

                </div>


                {{-- Metode Pembayaran --}}
                <div>

                    <p class="text-slate-500 mb-2">
                        Metode Pembayaran
                    </p>

                    @php
                        $metode = strtolower(
                            $penjualan->metode_pembayaran ?? ''
                        );
                    @endphp


                    @if($metode === 'cash')

                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-600 text-xs font-semibold">

                            <i data-lucide="banknote"
                               class="w-3.5 h-3.5">
                            </i>

                            Cash

                        </span>


                    @elseif($metode === 'transfer')

                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-50 text-blue-600 text-xs font-semibold">

                            <i data-lucide="landmark"
                               class="w-3.5 h-3.5">
                            </i>

                            Transfer

                        </span>


                    @elseif($metode === 'qris')

                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-purple-50 text-purple-600 text-xs font-semibold">

                            <i data-lucide="qr-code"
                               class="w-3.5 h-3.5">
                            </i>

                            QRIS

                        </span>


                    @else

                        <span class="text-slate-400">
                            -
                        </span>

                    @endif

                </div>


                {{-- Status --}}
                <div>

                    <p class="text-slate-500 mb-2">
                        Status
                    </p>


                    @if(strtolower($penjualan->status ?? '') === 'completed')

                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-600 text-xs font-semibold">

                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                            Completed

                        </span>

                    @else

                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-50 text-amber-600 text-xs font-semibold">

                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>

                            {{ ucfirst($penjualan->status ?? 'Open') }}

                        </span>

                    @endif

                </div>


                {{-- Total --}}
                <div class="border-t border-slate-100 pt-4">

                    <div class="flex items-center justify-between gap-4">

                        <span class="font-semibold text-slate-800">
                            Total Bayar
                        </span>

                        <span class="font-bold text-indigo-600 text-xl">

                            Rp
                            {{ number_format(
                                $penjualan->total_pembayaran ?? 0,
                                0,
                                ',',
                                '.'
                            ) }}

                        </span>

                    </div>

                </div>

                @if(strtolower($penjualan->metode_pembayaran ?? '') === 'cash')
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-slate-600">Uang Dibayar</span>
                        <span class="font-semibold text-slate-800">
                            Rp {{ number_format($penjualan->uang_dibayar ?? 0, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-slate-600">Kembalian</span>
                        <span class="font-bold text-emerald-600">
                            Rp {{ number_format($penjualan->kembalian ?? 0, 0, ',', '.') }}
                        </span>
                    </div>
                @endif

            </div>

        </div>


        {{-- Tombol Kembali --}}
        <a href="{{ route('penjualan.index') }}"
           class="mt-4 w-full inline-flex items-center justify-center gap-2 px-5 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-xl transition">

            <i data-lucide="arrow-left" class="w-4 h-4"></i>

            Kembali ke Data Penjualan

        </a>

    </div>

</div>

@endsection


@push('scripts')

<script>

    document.addEventListener('DOMContentLoaded', function () {

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

    });

</script>

@endpush
