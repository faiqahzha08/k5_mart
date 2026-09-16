@extends('layouts.app')

@section('title', 'Tambah Produk - K5 Mart')

@section('content')

<div class="mb-8">

    <a href="{{ route('produk.index') }}"
       class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-indigo-600 transition">

        <i data-lucide="arrow-left" class="w-4 h-4"></i>

        Kembali

    </a>

    <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-4">
        Tambah Produk
    </h1>

    <p class="text-sm text-slate-500 mt-1">
        Tambahkan produk baru ke dalam sistem
    </p>

</div>


<div class="max-w-3xl">

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <form action="{{ route('produk.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf


            {{-- NAMA PRODUK --}}
            <div class="mb-5">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Nama Produk
                </label>

                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama') }}"
                    required
                    placeholder="Contoh: Televisi Samsung"
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200
                           outline-none focus:border-indigo-400
                           focus:ring-2 focus:ring-indigo-100">

                @error('nama')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- JENIS PRODUK --}}
            <div class="mb-5">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Jenis Produk
                </label>

                <select
                    name="jenis_produk_id"
                    required
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200
                           bg-white outline-none focus:border-indigo-400
                           focus:ring-2 focus:ring-indigo-100">

                    <option value="">
                        -- Pilih Jenis Produk --
                    </option>

                    @foreach($jenisProduks as $jenis)

                        <option
                            value="{{ $jenis->id }}"
                            {{ old('jenis_produk_id') == $jenis->id ? 'selected' : '' }}>

                            {{ $jenis->nama }}

                        </option>

                    @endforeach

                </select>

                @error('jenis_produk_id')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- HARGA POKOK --}}
            <div class="mb-5">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Harga Pokok
                </label>

                <div class="relative">

                    <span class="absolute left-4 top-1/2 -translate-y-1/2
                                 text-sm text-slate-500">
                        Rp
                    </span>

                    <input
                        type="number"
                        name="harga_beli"
                        value="{{ old('harga_beli') }}"
                        required
                        min="0"
                        placeholder="0"
                        class="w-full pl-12 pr-4 py-2.5 rounded-xl
                               border border-slate-200 outline-none
                               focus:border-indigo-400
                               focus:ring-2 focus:ring-indigo-100">

                </div>

                @error('harga_beli')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- HARGA JUAL --}}
            <div class="mb-5">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Harga Jual
                </label>

                <div class="relative">

                    <span class="absolute left-4 top-1/2 -translate-y-1/2
                                 text-sm text-slate-500">
                        Rp
                    </span>

                    <input
                        type="number"
                        name="harga_jual"
                        value="{{ old('harga_jual') }}"
                        required
                        min="0"
                        placeholder="0"
                        class="w-full pl-12 pr-4 py-2.5 rounded-xl
                               border border-slate-200 outline-none
                               focus:border-indigo-400
                               focus:ring-2 focus:ring-indigo-100">

                </div>

                @error('harga_jual')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- STOK --}}
            <div class="mb-5">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Stok
                </label>

                <input
                    type="number"
                    name="stok"
                    value="{{ old('stok', 0) }}"
                    required
                    min="0"
                    placeholder="0"
                    class="w-full px-4 py-2.5 rounded-xl
                           border border-slate-200 outline-none
                           focus:border-indigo-400
                           focus:ring-2 focus:ring-indigo-100">

                @error('stok')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- FOTO --}}
            <div class="mb-6">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Foto Produk
                </label>

                <input
                    type="file"
                    name="foto"
                    accept="image/jpeg,image/jpg,image/png"
                    class="w-full px-4 py-2.5 rounded-xl
                           border border-slate-200
                           bg-white text-sm">

                <p class="mt-1 text-xs text-slate-400">
                    Format: JPG, JPEG, PNG. Maksimal 2 MB.
                </p>

                @error('foto')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- BUTTON --}}
            <div class="flex justify-end gap-3 pt-2">

                <a
                    href="{{ route('produk.index') }}"
                    class="inline-flex items-center gap-2
                           px-5 py-2.5 rounded-xl
                           border border-slate-200
                           text-sm font-medium text-slate-600
                           hover:bg-slate-50 transition">

                    <i data-lucide="x" class="w-4 h-4"></i>

                    Batal

                </a>


                <button
                    type="submit"
                    class="inline-flex items-center gap-2
                           px-5 py-2.5 rounded-xl
                           bg-indigo-600 hover:bg-indigo-700
                           text-white text-sm font-medium
                           transition shadow-sm">

                    <i data-lucide="save" class="w-4 h-4"></i>

                    Simpan Produk

                </button>

            </div>

        </form>

    </div>

</div>

@endsection
