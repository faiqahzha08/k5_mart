<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profile.
     */
    public function index()
    {
        $user = auth()->user()->load('role');

        return view('profile.index', compact('user'));
    }

    /**
     * Menampilkan halaman edit profile.
     */
    public function edit()
    {
        $user = auth()->user()->load('role');

        return view('profile.edit', compact('user'));
    }

    /**
     * Menyimpan perubahan profile.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        // Update nama
        $user->name = $validated['name'];

        // Update email
        $user->email = $validated['email'];

        // Update password jika diisi
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()
            ->route('profile')
            ->with('success', 'Profile berhasil diperbarui.');
    }
}