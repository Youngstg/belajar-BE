<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Ukuran maksimal 2MB
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar) {
                Storage::delete('public/avatars/' . $user->avatar);
            }

            // Simpan avatar baru
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath; // Simpan path ke database
        }

        $user->save(); // Simpan perubahan ke database

        return redirect()->route('settings.index')->with('success', 'Avatar updated successfully.');
    }
}
