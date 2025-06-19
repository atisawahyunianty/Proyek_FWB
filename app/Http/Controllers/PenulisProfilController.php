<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;

class PenulisProfilController extends Controller
{
    public function editProfil()
    {
        $user = auth()->user();
        $profil = Profil::firstOrCreate(['user_id' => $user->id]);

        return view('penulis.editProfil', compact('profil', 'user'));
    }

    public function updateProfil(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $profil = Profil::firstOrCreate(['user_id' => $user->id]);

        // Simpan foto jika diunggah
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto', $filename);
            $profil->profile_photo = $filename;
        }

        $profil->name = $request->name;
        $profil->save();

        return redirect()->route('penulis.profil')->with('success', 'Profil berhasil diperbarui');
    }
}
