@extends('layouts.app')
@section('title', 'Edit Informasi Toko')
@section('content')
<div class="mx-auto max-w-4xl">
    <a href="{{ route('tentang.index') }}" class="mb-5 inline-flex items-center gap-2 text-sm text-slate-500 hover:text-indigo-600"><i data-lucide="arrow-left" class="h-4 w-4"></i> Kembali ke Tentang Toko</a>
    <h1 class="text-3xl font-bold text-slate-900">Edit Informasi Toko</h1>
    <p class="mt-2 mb-6 text-sm text-slate-500">Perbarui informasi yang akan ditampilkan kepada pengguna aplikasi.</p>
    @if($errors->any())
        <div role="alert" class="mb-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">Perubahan belum disimpan. Periksa kolom yang ditandai di bawah.</div>
    @endif
    <form method="POST" action="{{ route('tentang.update') }}" class="space-y-6">
        @csrf
        @method('PUT')
        @php
            $sections = [
                'Identitas Toko' => ['nama_toko' => 'Nama Toko', 'tagline' => 'Tagline', 'deskripsi' => 'Profil Toko'],
                'Cerita & Tujuan' => ['sejarah' => 'Sejarah Toko', 'visi' => 'Visi', 'misi' => 'Misi', 'produk_layanan' => 'Produk & Layanan'],
                'Alamat & Kontak' => ['alamat' => 'Alamat Toko', 'telepon' => 'Nomor Telepon', 'email' => 'Email'],
            ];
            $shortFields = ['nama_toko', 'tagline', 'telepon', 'email'];
        @endphp
        @foreach($sections as $section => $fields)
            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-5 text-lg font-bold text-slate-900">{{ $section }}</h2>
                <div class="space-y-5">
                    @foreach($fields as $field => $label)
                        <div>
                            <label for="{{ $field }}" class="mb-2 block text-sm font-semibold text-slate-700">{{ $label }} @if($field === 'nama_toko')<span class="text-rose-500">*</span>@endif</label>
                            @if(in_array($field, $shortFields))
                                <input id="{{ $field }}" name="{{ $field }}" type="{{ $field === 'email' ? 'email' : ($field === 'telepon' ? 'tel' : 'text') }}" value="{{ old($field, $toko->$field) }}" maxlength="{{ $field === 'telepon' ? 30 : 255 }}" @required($field === 'nama_toko') class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                            @else
                                <textarea id="{{ $field }}" name="{{ $field }}" rows="{{ $field === 'alamat' ? 3 : 5 }}" maxlength="{{ $field === 'alamat' ? 2000 : 10000 }}" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm leading-6 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100">{{ old($field, $toko->$field) }}</textarea>
                            @endif
                            @if(in_array($field, ['misi', 'produk_layanan']))<p class="mt-1 text-xs text-slate-500">Tulis satu poin per baris agar tampil sebagai daftar.</p>@endif
                            @error($field)<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach
        <div class="flex flex-wrap justify-end gap-3">
            <a href="{{ route('tentang.index') }}" class="rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-50">Batal</a>
            <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700"><i data-lucide="save" class="h-4 w-4"></i> Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
