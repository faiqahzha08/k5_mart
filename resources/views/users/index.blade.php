@extends('layouts.app')

@section('title', 'User - K5 Mart')

@section('content')
<div class="space-y-8">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Manajemen User</h1>
            <p class="mt-1 text-sm text-slate-500">
                Kelola akun pengguna sistem POS
            </p>
        </div>

        <a href="{{ route('user.create') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-indigo-700 transition">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah User
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">#</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">Nama</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">Role</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-slate-600">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($users as $index => $user)

                        <tr class="hover:bg-slate-50">

                            <td class="px-6 py-4">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-500 text-white font-semibold">

                                        {{ strtoupper(substr($user->name,0,1)) }}

                                    </div>

                                    <div>
                                        <div class="font-medium text-slate-800">
                                            {{ $user->name }}
                                        </div>
                                    </div>

                                </div>

                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $user->email }}
                            </td>

                            <td class="px-6 py-4">

                                @php
                                    $role = $user->role?->nama ?? 'User';
                                @endphp

                                @if(strtolower($role) == 'admin')

                                    <span
                                        class="rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold text-indigo-700">
                                        Admin
                                    </span>

                                @elseif(strtolower($role) == 'kasir')

                                    <span
                                        class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                        Kasir
                                    </span>

                                @else

                                    <span
                                        class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                        {{ $role }}
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-end gap-2">

                                    <a href="{{ route('user.edit',$user->id) }}"
                                        class="rounded-lg p-2 text-slate-500 hover:bg-indigo-50 hover:text-indigo-600">

                                        <i data-lucide="pencil" class="w-4 h-4"></i>

                                    </a>

                                    @if(auth()->id() != $user->id)

                                        <form action="{{ route('user.destroy',$user->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus user ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="rounded-lg p-2 text-slate-500 hover:bg-red-50 hover:text-red-600">

                                                <i data-lucide="trash-2" class="w-4 h-4"></i>

                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="py-16 text-center text-slate-500">

                                Belum ada data user.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
@endsection
