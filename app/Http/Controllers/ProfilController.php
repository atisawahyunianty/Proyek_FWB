<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Profil;

class ProfilController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $profil = $user->profil;

        // Jika profil belum dibuat, buat profil default
        if (!$profil) {
            $profil = Profil::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'bio' => '',
                'social_media_links' => '',
                'profile_photo' => null,
            ]);
        }

        return view('profilpembaca.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $profil = $user->profil;

        // Jika belum punya profil, buat dulu
        if (!$profil) {
            $profil = Profil::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'bio' => '',
                'social_media_links' => '',
                'profile_photo' => null,
            ]);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'social_media_links' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan foto profil ke folder "public/storage/covers"
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time().'_'.$file->getClientOriginalName();

            // Pastikan direktori ada
            $destinationPath = public_path('storage/covers');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            $profil->profile_photo = 'covers/' . $filename;
        }

        $profil->name = $request->name;
        $profil->bio = $request->bio;
        $profil->social_media_links = $request->social_media_links;
        $profil->save();

        // Update nama juga di tabel users
        $user->name = $request->name;
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
