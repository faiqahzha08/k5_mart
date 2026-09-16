@extends('layouts.app')
@section('title', 'Tentang Toko')
@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-widest text-indigo-600">Kenali toko kami</p>
            <h1 class="mt-2 text-3xl font-bold text-slate-900">Tentang Toko</h1>
            <p class="mt-2 text-sm text-slate-500">Profil, tujuan, dan informasi toko dalam satu halaman.</p>
        </div>
        @if(strtolower(optional(auth()->user()->role)->nama ?? '') === 'admin')
            <a href="{{ route('tentang.edit') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700">
                <i data-lucide="square-pen" class="h-4 w-4"></i> Edit Informasi Toko
            </a>
        @endif
    </div>

    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 bg-indigo-50 p-6 sm:p-8">
            <div class="flex items-center gap-4">
                <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-indigo-600 text-white">
                    <i data-lucide="store" class="h-8 w-8"></i>
                </div>
                <div class="min-w-0">
                    <h2 class="break-words text-2xl font-bold text-slate-900">{{ $toko->nama_toko }}</h2>
                    <p class="mt-1 break-words text-sm text-indigo-700">{{ $toko->tagline }}</p>
                </div>
            </div>
        </div>
        <div class="p-6 sm:p-8">
            <h3 class="mb-3 font-semibold text-slate-900">Profil Toko</h3>
            <p class="whitespace-pre-line break-words text-sm leading-7 text-slate-600">{{ $toko->deskripsi ?: 'Profil toko belum diisi.' }}</p>
        </div>
    </section>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-2">
            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-4 flex items-center gap-3 text-lg font-bold"><i data-lucide="history" class="h-5 w-5 text-indigo-600"></i> Sejarah Toko</h2>
                <p class="whitespace-pre-line break-words text-sm leading-7 text-slate-600">{{ $toko->sejarah ?: 'Sejarah toko belum diisi.' }}</p>
            </section>
            <div class="grid gap-6 sm:grid-cols-2">
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-4 flex items-center gap-3 text-lg font-bold"><i data-lucide="eye" class="h-5 w-5 text-indigo-600"></i> Visi</h2>
                    <p class="whitespace-pre-line break-words text-sm leading-7 text-slate-600">{{ $toko->visi ?: 'Visi toko belum diisi.' }}</p>
                </section>
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-4 flex items-center gap-3 text-lg font-bold"><i data-lucide="target" class="h-5 w-5 text-indigo-600"></i> Misi</h2>
                    <ul class="space-y-3">
                        @forelse(array_filter(preg_split('/\r\n|\r|\n/', $toko->misi ?? ''), fn ($item) => trim($item) !== '') as $misi)
                            <li class="flex gap-3 text-sm leading-6 text-slate-600"><i data-lucide="check-circle-2" class="mt-1 h-4 w-4 shrink-0 text-indigo-600"></i><span class="min-w-0 break-words">{{ $misi }}</span></li>
                        @empty
                            <li class="text-sm text-slate-500">Misi toko belum diisi.</li>
                        @endforelse
                    </ul>
                </section>
            </div>
        </div>
        <aside class="space-y-6">
            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-5 flex items-center gap-3 text-lg font-bold"><i data-lucide="map-pin" class="h-5 w-5 text-indigo-600"></i> Alamat & Kontak</h2>
                <dl class="space-y-5 text-sm">
                    @foreach(['alamat' => 'Alamat Toko', 'telepon' => 'Nomor Telepon', 'email' => 'Email'] as $field => $label)
                        <div><dt class="mb-1 text-slate-500">{{ $label }}</dt><dd class="whitespace-pre-line break-words font-medium leading-6 text-slate-800">{{ $toko->$field ?: 'Belum diisi' }}</dd></div>
                    @endforeach
                </dl>
            </section>
            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-4 flex items-center gap-3 text-lg font-bold"><i data-lucide="shopping-basket" class="h-5 w-5 text-indigo-600"></i> Produk & Layanan</h2>
                <ul class="space-y-3">
                    @forelse(array_filter(preg_split('/\r\n|\r|\n/', $toko->produk_layanan ?? ''), fn ($item) => trim($item) !== '') as $layanan)
                        <li class="flex gap-3 text-sm leading-6 text-slate-600"><span class="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-indigo-500"></span><span class="min-w-0 break-words">{{ $layanan }}</span></li>
                    @empty
                        <li class="text-sm text-slate-500">Produk dan layanan belum diisi.</li>
                    @endforelse
                </ul>
            </section>
        </aside>
    </div>
</div>
@endsection
