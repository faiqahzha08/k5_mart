@extends('layouts.app')

@section('title', 'Penjualan - K5 Mart')

@section('content')

<div class="mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
                Data Penjualan
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Riwayat transaksi penjualan
            </p>
        </div>

        <a href="{{ route('penjualan.create') }}"
           class="inline-flex items-center justify-center gap-2 px-5 py-3
                  bg-indigo-600 hover:bg-indigo-700 text-white
                  text-sm font-semibold rounded-xl transition shadow-sm shadow-indigo-200">

            <i data-lucide="plus" class="w-4 h-4"></i>
            Transaksi Baru
        </a>

    </div>
</div>





{{-- ALERT ERROR --}}
@if(session('error'))
    <div class="mb-5 rounded-xl border border-red-200 bg-red-50
                px-4 py-3 text-sm text-red-700">

        <div class="flex items-center gap-2">
            <i data-lucide="alert-circle" class="w-5 h-5"></i>
            <span>{{ session('error') }}</span>
        </div>

    </div>
@endif


{{-- STATISTIK --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-7">

    {{-- TOTAL TRANSAKSI --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

        <div class="flex items-center gap-3">

            <div class="w-11 h-11 rounded-xl bg-indigo-100
                        flex items-center justify-center">

                <i data-lucide="shopping-cart"
                   class="w-5 h-5 text-indigo-600"></i>

            </div>

            <div>
                <p class="text-xs text-slate-500">
                    Total Transaksi
                </p>

                <p class="text-xl font-bold text-slate-900">
                    {{ number_format($totalTransaksi, 0, ',', '.') }}
                </p>
            </div>

        </div>

    </div>


    {{-- TOTAL OMZET --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

        <div class="flex items-center gap-3">

            <div class="w-11 h-11 rounded-xl bg-emerald-100
                        flex items-center justify-center">

                <i data-lucide="wallet"
                   class="w-5 h-5 text-emerald-600"></i>

            </div>

            <div>
                <p class="text-xs text-slate-500">
                    Total Omzet
                </p>

                <p class="text-xl font-bold text-slate-900">
                    Rp {{ number_format($totalOmzet, 0, ',', '.') }}
                </p>
            </div>

        </div>

    </div>


    {{-- HARI INI --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

        <div class="flex items-center gap-3">

            <div class="w-11 h-11 rounded-xl bg-amber-100
                        flex items-center justify-center">

                <i data-lucide="calendar-days"
                   class="w-5 h-5 text-amber-600"></i>

            </div>

            <div>
                <p class="text-xs text-slate-500">
                    Hari Ini
                </p>

                <p class="text-xl font-bold text-slate-900">
                    {{ number_format($hariIni, 0, ',', '.') }}
                </p>
            </div>

        </div>

    </div>

</div>


{{-- TABEL PENJUALAN --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">

                    <th class="text-left px-5 py-4 font-semibold text-slate-600">
                        #
                    </th>

                    <th class="text-left px-5 py-4 font-semibold text-slate-600">
                        No. Transaksi
                    </th>

                    <th class="text-left px-5 py-4 font-semibold text-slate-600">
                        Tanggal
                    </th>

                    <th class="text-left px-5 py-4 font-semibold text-slate-600">
                        Kasir
                    </th>

                    <th class="text-left px-5 py-4 font-semibold text-slate-600">
                        Metode
                    </th>

                    <th class="text-left px-5 py-4 font-semibold text-slate-600">
                        Status
                    </th>

                    <th class="text-right px-5 py-4 font-semibold text-slate-600">
                        Total
                    </th>

                    <th class="text-center px-5 py-4 font-semibold text-slate-600">
                        Aksi
                    </th>

                </tr>
            </thead>


            <tbody class="divide-y divide-slate-100">

                @forelse($penjualans as $index => $penjualan)

                    <tr class="hover:bg-slate-50 transition">

                        {{-- NOMOR --}}
                        <td class="px-5 py-4 text-slate-500">
                            {{ $penjualans->firstItem() + $index }}
                        </td>


                        {{-- KODE TRANSAKSI --}}
                        <td class="px-5 py-4">

                            <span class="font-semibold text-slate-800">
                                #{{ $penjualan->id }}
                            </span>

                        </td>


                        {{-- TANGGAL --}}
                        <td class="px-5 py-4 text-slate-600 whitespace-nowrap">

                            {{ $penjualan->created_at
                                ? $penjualan->created_at->format('d M Y H:i')
                                : '-' }}

                        </td>


                        {{-- KASIR --}}
                        <td class="px-5 py-4 text-slate-600">

                            {{ $penjualan->user->name ?? '-' }}

                        </td>


                        {{-- METODE PEMBAYARAN --}}
                        <td class="px-5 py-4">

                            @php
                                $metode = strtolower($penjualan->metode_pembayaran ?? 'cash');
                            @endphp


                            @if($metode === 'transfer')

                                <span class="inline-flex items-center gap-1.5
                                             px-3 py-1.5 rounded-lg
                                             bg-blue-50 text-blue-600
                                             text-xs font-semibold">

                                    <i data-lucide="building-2"
                                       class="w-3.5 h-3.5"></i>

                                    Transfer

                                </span>


                            @elseif($metode === 'qris')

                                <span class="inline-flex items-center gap-1.5
                                             px-3 py-1.5 rounded-lg
                                             bg-purple-50 text-purple-600
                                             text-xs font-semibold">

                                    <i data-lucide="qr-code"
                                       class="w-3.5 h-3.5"></i>

                                    QRIS

                                </span>


                            @else

                                <span class="inline-flex items-center gap-1.5
                                             px-3 py-1.5 rounded-lg
                                             bg-emerald-50 text-emerald-600
                                             text-xs font-semibold">

                                    <i data-lucide="banknote"
                                       class="w-3.5 h-3.5"></i>

                                    Cash

                                </span>

                            @endif

                        </td>


                        {{-- STATUS --}}
                        <td class="px-5 py-4">

                            <span class="inline-flex items-center gap-1.5
                                         px-3 py-1.5 rounded-lg
                                         bg-emerald-50 text-emerald-600
                                         text-xs font-semibold">

                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                Completed

                            </span>

                        </td>


                        {{-- TOTAL --}}
                        <td class="px-5 py-4 text-right whitespace-nowrap">

                            <span class="font-bold text-slate-800">

                                Rp {{ number_format(
                                    $penjualan->total_pembayaran ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </span>

                        </td>


                        {{-- AKSI --}}
                        <td class="px-5 py-4">

                            <div class="flex items-center justify-center">

                                {{-- DETAIL --}}
                                <a href="{{ route('penjualan.show', $penjualan->id) }}"
                                   class="inline-flex items-center gap-1.5
                                          px-3 py-2 rounded-lg
                                          bg-indigo-50 hover:bg-indigo-100
                                          text-indigo-600
                                          text-xs font-semibold transition">

                                    <i data-lucide="file-text"
                                       class="w-4 h-4"></i>

                                    Detail

                                </a>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8"
                            class="px-5 py-12 text-center">

                            <div class="flex flex-col items-center justify-center">

                                <div class="w-14 h-14 rounded-full bg-slate-100
                                            flex items-center justify-center mb-3">

                                    <i data-lucide="receipt"
                                       class="w-7 h-7 text-slate-400"></i>

                                </div>

                                <p class="font-semibold text-slate-700">
                                    Belum ada transaksi
                                </p>

                                <p class="text-sm text-slate-500 mt-1">
                                    Data transaksi penjualan akan muncul di sini.
                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- PAGINATION --}}
    @if($penjualans->hasPages())

        <div class="px-5 py-4 border-t border-slate-200">

            <div class="flex flex-col sm:flex-row
                        items-center justify-between gap-4">

                {{-- INFORMASI DATA --}}
                <div class="text-sm text-slate-500">

                    Menampilkan

                    <span class="font-semibold text-slate-700">
                        {{ $penjualans->firstItem() }}
                    </span>

                    sampai

                    <span class="font-semibold text-slate-700">
                        {{ $penjualans->lastItem() }}
                    </span>

                    dari

                    <span class="font-semibold text-slate-700">
                        {{ $penjualans->total() }}
                    </span>

                    transaksi

                </div>


                {{-- BUTTON PAGINATION --}}
                <div class="flex items-center gap-1">

                    {{-- PREVIOUS --}}
                    @if($penjualans->onFirstPage())

                        <span class="inline-flex items-center justify-center
                                     min-w-9 h-9 px-3 rounded-lg
                                     border border-slate-200
                                     text-slate-300 bg-slate-50
                                     text-sm">

                            <i data-lucide="chevron-left"
                               class="w-4 h-4"></i>

                        </span>

                    @else

                        <a href="{{ $penjualans->previousPageUrl() }}"
                           class="inline-flex items-center justify-center
                                  min-w-9 h-9 px-3 rounded-lg
                                  border border-slate-200
                                  text-slate-600 bg-white
                                  hover:bg-indigo-50 hover:text-indigo-600
                                  hover:border-indigo-200 transition">

                            <i data-lucide="chevron-left"
                               class="w-4 h-4"></i>

                        </a>

                    @endif


                    {{-- NOMOR HALAMAN --}}
                    @foreach($penjualans->getUrlRange(
                        max(1, $penjualans->currentPage() - 2),
                        min($penjualans->lastPage(), $penjualans->currentPage() + 2)
                    ) as $page => $url)

                        @if($page == $penjualans->currentPage())

                            <span class="inline-flex items-center justify-center
                                         min-w-9 h-9 px-3 rounded-lg
                                         bg-indigo-600 text-white
                                         text-sm font-semibold shadow-sm">

                                {{ $page }}

                            </span>

                        @else

                            <a href="{{ $url }}"
                               class="inline-flex items-center justify-center
                                      min-w-9 h-9 px-3 rounded-lg
                                      border border-slate-200
                                      bg-white text-slate-600
                                      hover:bg-indigo-50
                                      hover:text-indigo-600
                                      hover:border-indigo-200
                                      transition text-sm">

                                {{ $page }}

                            </a>

                        @endif

                    @endforeach


                    {{-- NEXT --}}
                    @if($penjualans->hasMorePages())

                        <a href="{{ $penjualans->nextPageUrl() }}"
                           class="inline-flex items-center justify-center
                                  min-w-9 h-9 px-3 rounded-lg
                                  border border-slate-200
                                  text-slate-600 bg-white
                                  hover:bg-indigo-50 hover:text-indigo-600
                                  hover:border-indigo-200 transition">

                            <i data-lucide="chevron-right"
                               class="w-4 h-4"></i>

                        </a>

                    @else

                        <span class="inline-flex items-center justify-center
                                     min-w-9 h-9 px-3 rounded-lg
                                     border border-slate-200
                                     text-slate-300 bg-slate-50">

                            <i data-lucide="chevron-right"
                               class="w-4 h-4"></i>

                        </span>

                    @endif

                </div>

            </div>

        </div>

    @endif

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
