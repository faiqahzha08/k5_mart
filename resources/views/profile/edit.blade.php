@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

<div class="max-w-3xl mx-auto">


    {{-- Header --}}
    <div class="mb-8">

        <h1 class="text-3xl font-bold
                   text-slate-900">

            Edit Profile

        </h1>

        <p class="mt-1 text-sm text-slate-500">

            Perbarui informasi akun kamu

        </p>

    </div>


    {{-- Error Validation --}}
    @if($errors->any())

        <div class="mb-6 rounded-xl
                    border border-red-200
                    bg-red-50 px-5 py-4">

            <ul class="list-disc pl-5
                       text-sm text-red-600">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Form Card --}}
    <div class="rounded-2xl
                border border-slate-200
                bg-white p-8
                shadow-sm">


        <form action="{{ route('profile.update') }}"
              method="POST">

            @csrf

            @method('PUT')


            {{-- Nama --}}
            <div class="mb-6">

                <label class="mb-2 block
                              text-sm font-semibold
                              text-slate-700">

                    Nama Lengkap

                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    required
                    class="w-full rounded-xl
                           border border-slate-300
                           px-4 py-3
                           text-slate-900
                           outline-none
                           transition
                           focus:border-indigo-500
                           focus:ring-2
                           focus:ring-indigo-100"
                >

            </div>


            {{-- Email --}}
            <div class="mb-6">

                <label class="mb-2 block
                              text-sm font-semibold
                              text-slate-700">

                    Email

                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    required
                    class="w-full rounded-xl
                           border border-slate-300
                           px-4 py-3
                           text-slate-900
                           outline-none
                           transition
                           focus:border-indigo-500
                           focus:ring-2
                           focus:ring-indigo-100"
                >

            </div>


            <hr class="my-8
                       border-slate-200">


            {{-- Password --}}
            <div class="mb-6">

                <h3 class="mb-1 text-lg
                           font-bold text-slate-900">

                    Ubah Password

                </h3>

                <p class="mb-5 text-sm
                          text-slate-500">

                    Kosongkan jika tidak ingin
                    mengubah password.

                </p>


                <label class="mb-2 block
                              text-sm font-semibold
                              text-slate-700">

                    Password Baru

                </label>

                <input
                    type="password"
                    name="password"
                    class="w-full rounded-xl
                           border border-slate-300
                           px-4 py-3
                           text-slate-900
                           outline-none
                           transition
                           focus:border-indigo-500
                           focus:ring-2
                           focus:ring-indigo-100"
                >

            </div>


            {{-- Konfirmasi Password --}}
            <div class="mb-8">

                <label class="mb-2 block
                              text-sm font-semibold
                              text-slate-700">

                    Konfirmasi Password

                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="w-full rounded-xl
                           border border-slate-300
                           px-4 py-3
                           text-slate-900
                           outline-none
                           transition
                           focus:border-indigo-500
                           focus:ring-2
                           focus:ring-indigo-100"
                >

            </div>


            {{-- Tombol --}}
            <div class="flex flex-col gap-3
                        sm:flex-row
                        sm:justify-end">


                {{-- Batal --}}
                <a href="{{ route('profile') }}"
                   class="inline-flex
                          items-center
                          justify-center
                          rounded-xl
                          border border-slate-300
                          px-5 py-2.5
                          font-medium
                          text-slate-700
                          transition
                          hover:bg-slate-50">

                    Batal

                </a>


                {{-- Simpan --}}
                <button
                    type="submit"
                    class="inline-flex
                           items-center
                           justify-center
                           gap-2 rounded-xl
                           bg-indigo-600
                           px-5 py-2.5
                           font-medium text-white
                           transition
                           hover:bg-indigo-700">

                    <i data-lucide="save"
                       class="h-4 w-4">
                    </i>

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection