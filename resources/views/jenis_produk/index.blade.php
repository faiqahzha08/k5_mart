@extends('layouts.app')

@section('title', 'Jenis Produk - K5 Mart')

@section('content')

<!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

    <div>
        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">
            Jenis Produk
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Kelola jenis atau kategori produk
        </p>
    </div>

    @if(strtolower(optional(Auth::user()->role)->nama ?? '') === 'admin')
    <a href="{{ route('jenis-produk.create') }}"
       class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl transition shadow-sm">

        <i data-lucide="plus" class="w-4 h-4"></i>

        Tambah Jenis Produk

    </a>
    @endif

</div>


<!-- Success -->
@if(session('success'))

    <div class="mb-6 px-4 py-3 rounded-xl bg-green-100 border border-green-200 text-green-700 text-sm">
        {{ session('success') }}
    </div>

@endif


<!-- Error -->
@if(session('error'))

    <div class="mb-6 px-4 py-3 rounded-xl bg-red-100 border border-red-200 text-red-700 text-sm">
        {{ session('error') }}
    </div>

@endif


<!-- Table -->
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <!-- Header Table -->
            <thead>

                <tr class="bg-slate-50 border-b border-slate-200">

                    <th class="px-6 py-4 text-left font-semibold text-slate-700">
                        #
                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-slate-700">
                        Nama Jenis Produk
                    </th>

                    <th class="px-6 py-4 text-center font-semibold text-slate-700">
                        Jumlah Produk
                    </th>

                    @if(strtolower(optional(Auth::user()->role)->nama ?? '') === 'admin')
                    <th class="px-6 py-4 text-right font-semibold text-slate-700">
                        Aksi
                    </th>
                    @endif

                </tr>

            </thead>


            <!-- Body Table -->
            <tbody class="divide-y divide-slate-100">

                @forelse($jenisProduks as $index => $jenis)

                    <tr class="hover:bg-slate-50 transition">

                        <!-- Nomor -->
                        <td class="px-6 py-4 text-slate-600">
                            {{ $index + 1 }}
                        </td>


                        <!-- Nama Jenis -->
                        <td class="px-6 py-4">

                            <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-indigo-100 text-indigo-700 text-xs font-medium">

                                {{ $jenis->nama }}

                            </span>

                        </td>


                        <!-- Jumlah Produk -->
                        <td class="px-6 py-4 text-center">

                            @if($jenis->produks_count > 0)

                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-medium">

                                    {{ $jenis->produks_count }} produk

                                </span>

                            @else

                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-medium">

                                    0 produk

                                </span>

                            @endif

                        </td>


                        @if(strtolower(optional(Auth::user()->role)->nama ?? '') === 'admin')
                        <!-- Aksi -->
                        <td class="px-6 py-4">

                            <div class="flex justify-end gap-2">

                                <!-- Edit -->
                                <a href="{{ route('jenis-produk.edit', $jenis->id) }}"
                                   title="Edit Jenis Produk"
                                   class="p-2 rounded-lg bg-yellow-100 hover:bg-yellow-200 transition">

                                    <i data-lucide="pencil"
                                       class="w-4 h-4 text-yellow-700"></i>

                                </a>


                                <!-- Hapus -->
                                <form action="{{ route('jenis-produk.destroy', $jenis->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus jenis produk {{ $jenis->nama }}?')">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit"
                                            title="Hapus Jenis Produk"
                                            class="p-2 rounded-lg bg-red-100 hover:bg-red-200 transition">

                                        <i data-lucide="trash-2"
                                           class="w-4 h-4 text-red-700"></i>

                                    </button>

                                </form>

                            </div>

                        </td>
                        @endif

                    </tr>

                @empty

                    <!-- Data Kosong -->
                    <tr>

                        <td colspan="{{ strtolower(optional(Auth::user()->role)->nama ?? '') === 'admin' ? 4 : 3 }}"
                            class="px-6 py-12 text-center">

                            <div class="flex flex-col items-center justify-center">

                                <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center mb-3">

                                    <i data-lucide="folder"
                                       class="w-7 h-7 text-slate-400"></i>

                                </div>

                                <p class="text-slate-600 font-medium">
                                    Belum ada jenis produk
                                </p>

                                <p class="text-sm text-slate-400 mt-1">
                                    Silakan tambahkan jenis produk baru.
                                </p>

                                @if(strtolower(optional(Auth::user()->role)->nama ?? '') === 'admin')
                                <a href="{{ route('jenis-produk.create') }}"
                                   class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm rounded-xl transition">

                                    <i data-lucide="plus" class="w-4 h-4"></i>

                                    Tambah Jenis Produk

                                </a>
                                @endif

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
