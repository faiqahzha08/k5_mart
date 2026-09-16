@extends('layouts.app')

@section('title', 'Edit Produk - K5 Mart')

@section('content')

<div class="mb-8">

    <a href="{{ route('produk.index') }}"
       class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-indigo-600">

        <i data-lucide="arrow-left" class="w-4 h-4"></i>

        Kembali

    </a>


    <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-4">
        Edit Produk
    </h1>

    <p class="text-sm text-slate-500 mt-1">
        Ubah informasi produk
    </p>

</div>


<div class="max-w-3xl">

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <form action="{{ route('produk.update', $produk->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            @method('PUT')


            <!-- NAMA -->
            <div class="mb-5">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Nama Produk
                </label>

                <input type="text"
                       name="nama"
                       value="{{ old('nama', $produk->nama) }}"
                       required
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-indigo-400">

                @error('nama')

                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            <!-- JENIS PRODUK -->
            <div class="mb-5">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Jenis Produk
                </label>

                <select name="jenis_produk_id"
                        required
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-indigo-400">

                    <option value="">
                        -- Pilih Jenis Produk --
                    </option>

                    @foreach($jenisProduks as $jenis)

                        <option value="{{ $jenis->id }}"
                            {{ old(
                                'jenis_produk_id',
                                $produk->jenis_produk_id
                            ) == $jenis->id ? 'selected' : '' }}>

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


            <!-- HARGA POKOK -->
            <div class="mb-5">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Harga Pokok
                </label>

                <input type="number"
                       name="harga_beli"
                       value="{{ old('harga_beli', $produk->harga_beli) }}"
                       required
                       min="0"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-indigo-400">

                @error('harga_beli')

                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            <!-- HARGA JUAL -->
            <div class="mb-5">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Harga Jual
                </label>

                <input type="number"
                       name="harga_jual"
                       value="{{ old('harga_jual', $produk->harga_jual) }}"
                       required
                       min="0"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-indigo-400">

                @error('harga_jual')

                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            <!-- STOK -->
            <div class="mb-5">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Stok
                </label>

                <input type="number"
                       name="stok"
                       value="{{ old('stok', $produk->stok) }}"
                       required
                       min="0"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-indigo-400">

                @error('stok')

                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            <!-- FOTO LAMA -->
            @if($produk->foto)

                <div class="mb-4">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Foto Saat Ini
                    </label>

                    <img src="{{ asset('storage/' . $produk->foto) }}"
                         class="w-24 h-24 object-cover rounded-xl border">

                </div>

            @endif


            <!-- FOTO BARU -->
            <div class="mb-6">

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Ganti Foto
                </label>

                <input type="file"
                       name="foto"
                       accept=".jpg,.jpeg,.png"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200">

                @error('foto')

                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            <!-- BUTTON -->
            <div class="flex justify-end gap-3">

                <a href="{{ route('produk.index') }}"
                   class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50">

                    Batal

                </a>


                <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white">

                    Update Produk

                </button>

            </div>

        </form>

    </div>

</div>

@endsection
