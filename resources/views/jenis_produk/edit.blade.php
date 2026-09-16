@extends('layouts.app')

@section('title', 'Edit Jenis Produk - K5 Mart')

@section('content')

<div class="mb-8">

    <a href="{{ route('jenis-produk.index') }}"
       class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-indigo-600 transition">

        <i data-lucide="arrow-left" class="w-4 h-4"></i>

        Kembali

    </a>

    <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-4">
        Edit Jenis Produk
    </h1>

    <p class="text-sm text-slate-500 mt-1">
        Ubah informasi jenis produk
    </p>

</div>


<div class="max-w-xl">

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <form action="{{ route('jenis-produk.update', $jenisProduk->id) }}"
              method="POST"
              class="space-y-5">

            @csrf

            @method('PUT')


            {{-- Nama Jenis Produk --}}
            <div>

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Nama Jenis Produk
                </label>

                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama', $jenisProduk->nama) }}"
                    required
                    autofocus
                    placeholder="Contoh: Makanan"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200
                           focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100
                           outline-none text-sm transition">

                @error('nama')

                    <p class="mt-1.5 text-xs text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- Tombol --}}
            <div class="flex items-center justify-end gap-3 pt-3">

                <a href="{{ route('jenis-produk.index') }}"
                   class="px-5 py-2.5 rounded-xl border border-slate-200
                          text-sm font-medium text-slate-600
                          hover:bg-slate-50 transition">

                    Batal

                </a>


                <button
                    type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5
                           bg-indigo-600 hover:bg-indigo-700
                           text-white text-sm font-medium rounded-xl
                           transition shadow-sm">

                    <i data-lucide="save" class="w-4 h-4"></i>

                    Update

                </button>

            </div>

        </form>

    </div>

</div>

@endsection
