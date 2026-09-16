@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">
            Profile
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Informasi akun pengguna
        </p>
    </div>


    {{-- Pesan sukses --}}
    @if(session('success'))

        <div class="mb-6 flex items-center gap-3
                    rounded-xl border border-green-200
                    bg-green-50 px-5 py-4
                    text-sm text-green-700">

            <i data-lucide="check-circle"
               class="h-5 w-5">
            </i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- Profile Card --}}
    <div class="overflow-hidden rounded-2xl
                border border-slate-200
                bg-white shadow-sm">


        {{-- Cover --}}
        <div class="h-32 bg-gradient-to-r
                    from-indigo-600 to-purple-600">
        </div>


        <div class="px-8 pb-8">


            {{-- Avatar --}}
            <div class="-mt-12 mb-6">

                <div class="flex h-24 w-24
                            items-center justify-center
                            rounded-2xl
                            border-4 border-white
                            bg-indigo-600
                            shadow-lg">

                    <i data-lucide="user"
                       class="h-12 w-12 text-white">
                    </i>

                </div>

            </div>


            {{-- User Header --}}
            <div class="flex flex-col gap-5
                        md:flex-row
                        md:items-start
                        md:justify-between">


                <div>

                    {{-- Nama --}}
                    <h2 class="text-2xl font-bold
                               text-slate-900">

                        {{ $user->name }}

                    </h2>


                    {{-- Email --}}
                    <p class="mt-1 text-slate-500">

                        {{ $user->email }}

                    </p>


                    {{-- Role --}}
                    <div class="mt-3 inline-flex
                                items-center gap-2
                                rounded-full
                                bg-indigo-50
                                px-3 py-1.5
                                text-sm font-medium
                                text-indigo-600">

                        <i data-lucide="shield"
                           class="h-4 w-4">
                        </i>

                        {{ ucfirst($user->role->nama ?? 'User') }}

                    </div>

                </div>


                {{-- Edit Button --}}
                <a href="{{ route('profile.edit') }}"
                   class="inline-flex
                          items-center
                          justify-center
                          gap-2 rounded-xl
                          bg-indigo-600
                          px-5 py-2.5
                          font-medium text-white
                          transition
                          hover:bg-indigo-700">

                    <i data-lucide="edit-3"
                       class="h-4 w-4">
                    </i>

                    Edit Profile

                </a>

            </div>


            {{-- Garis --}}
            <hr class="my-8 border-slate-200">


            {{-- Informasi Akun --}}
            <div>

                <h3 class="mb-5 text-lg font-bold
                           text-slate-900">

                    Informasi Akun

                </h3>


                <div class="grid grid-cols-1
                            gap-5 md:grid-cols-2">


                    {{-- Nama --}}
                    <div class="rounded-xl
                                bg-slate-50 p-5">

                        <div class="mb-2 flex
                                    items-center gap-3">

                            <div class="flex h-9 w-9
                                        items-center
                                        justify-center
                                        rounded-lg
                                        bg-indigo-100">

                                <i data-lucide="user"
                                   class="h-5 w-5
                                          text-indigo-600">
                                </i>

                            </div>

                            <span class="text-sm
                                         text-slate-500">

                                Nama Lengkap

                            </span>

                        </div>

                        <p class="font-semibold
                                  text-slate-900">

                            {{ $user->name }}

                        </p>

                    </div>


                    {{-- Email --}}
                    <div class="rounded-xl
                                bg-slate-50 p-5">

                        <div class="mb-2 flex
                                    items-center gap-3">

                            <div class="flex h-9 w-9
                                        items-center
                                        justify-center
                                        rounded-lg
                                        bg-blue-100">

                                <i data-lucide="mail"
                                   class="h-5 w-5
                                          text-blue-600">
                                </i>

                            </div>

                            <span class="text-sm
                                         text-slate-500">

                                Email

                            </span>

                        </div>

                        <p class="font-semibold
                                  text-slate-900">

                            {{ $user->email }}

                        </p>

                    </div>


                    {{-- Role --}}
                    <div class="rounded-xl
                                bg-slate-50 p-5">

                        <div class="mb-2 flex
                                    items-center gap-3">

                            <div class="flex h-9 w-9
                                        items-center
                                        justify-center
                                        rounded-lg
                                        bg-purple-100">

                                <i data-lucide="shield-check"
                                   class="h-5 w-5
                                          text-purple-600">
                                </i>

                            </div>

                            <span class="text-sm
                                         text-slate-500">

                                Role

                            </span>

                        </div>

                        <p class="font-semibold
                                  text-slate-900">

                            {{ ucfirst($user->role->nama ?? 'User') }}

                        </p>

                    </div>


                    {{-- Bergabung --}}
                    <div class="rounded-xl
                                bg-slate-50 p-5">

                        <div class="mb-2 flex
                                    items-center gap-3">

                            <div class="flex h-9 w-9
                                        items-center
                                        justify-center
                                        rounded-lg
                                        bg-green-100">

                                <i data-lucide="calendar"
                                   class="h-5 w-5
                                          text-green-600">
                                </i>

                            </div>

                            <span class="text-sm
                                         text-slate-500">

                                Bergabung Sejak

                            </span>

                        </div>

                        <p class="font-semibold
                                  text-slate-900">

                            {{ $user->created_at
                                ? $user->created_at->format('d M Y')
                                : '-' }}

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection