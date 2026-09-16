@extends('layouts.app')

@section('title','Detail Produk')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Detail Produk
            </h1>

            <p class="text-slate-500 mt-1">
                Informasi lengkap produk
            </p>
        </div>

        <a href="{{ route('produk.index') }}"
            class="px-5 py-2 bg-slate-200 hover:bg-slate-300 rounded-xl">
            ← Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <div class="grid grid-cols-1 md:grid-cols-2">

            <div class="p-8 flex justify-center items-center bg-slate-100">

                @if(!empty($produk->foto) && file_exists(public_path('storage/'.$produk->foto)))

                    <img
                        src="{{ asset('storage/'.$produk->foto) }}"
                        class="rounded-2xl shadow-lg w-96 h-96 object-cover">

                @else

                    <div class="w-96 h-96 rounded-2xl bg-gray-200 flex items-center justify-center">

                        Tidak Ada Foto

                    </div>

                @endif

            </div>

            <div class="p-8">

                <h2 class="text-3xl font-bold mb-6">
                    {{ $produk->nama }}
                </h2>

                <div class="space-y-5">

                    <div>
                        <label class="text-slate-500 text-sm">Harga Pokok</label>

                        <div class="text-xl font-semibold">
                            Rp {{ number_format($produk->harga_beli,0,',','.') }}
                        </div>
                    </div>

                    <div>
                        <label class="text-slate-500 text-sm">Harga Jual</label>

                        <div class="text-xl font-semibold text-green-600">
                            Rp {{ number_format($produk->harga_jual,0,',','.') }}
                        </div>
                    </div>

                    <div>

                        <label class="text-slate-500 text-sm">
                            Stok
                        </label>

                        <div>

                            @if($produk->stok<=0)

                                <span class="px-4 py-2 rounded-full bg-red-100 text-red-600">
                                    Habis
                                </span>

                            @elseif($produk->stok<10)

                                <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700">
                                    {{ $produk->stok }}
                                </span>

                            @else

                                <span class="px-4 py-2 rounded-full bg-green-100 text-green-700">
                                    {{ $produk->stok }}
                                </span>

                            @endif

                        </div>

                    </div>

                    <div>
                        <label class="text-slate-500 text-sm">
                            Ditambahkan Oleh
                        </label>

                        <div class="font-semibold">
                            {{ optional($produk->user)->name ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <label class="text-slate-500 text-sm">
                            Dibuat
                        </label>

                        <div>
                            {{ optional($produk->created_at)->format('d M Y H:i') }}
                        </div>
                    </div>

                    <div>
                        <label class="text-slate-500 text-sm">
                            Terakhir Diubah
                        </label>

                        <div>
                            {{ optional($produk->updated_at)->format('d M Y H:i') }}
                        </div>
                    </div>

                </div>

                @if(strtolower(optional(Auth::user()->role)->nama ?? '') === 'admin')
                <div class="flex gap-3 mt-10">

                    <a
                        href="{{ route('produk.edit',$produk->id) }}"
                        class="px-6 py-3 bg-indigo-600 text-white rounded-xl">
                        Edit Produk
                    </a>

                    <form
                        action="{{ route('produk.destroy',$produk->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')">

                        @csrf
                        @method('DELETE')

                        <button
                            class="px-6 py-3 bg-red-600 text-white rounded-xl">
                            Hapus
                        </button>

                    </form>

                </div>
                @endif

            </div>

        </div>

    </div>

</div>

@endsection
