<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    // Menampilkan semua pengguna non-admin
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Kamu bukan admin!');
        }

        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.KelolaPengguna', compact('users'));
    }

    // Menghapus pengguna berdasarkan ID dengan TRANSAKSI
    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Kamu bukan admin!');
        }

        DB::beginTransaction(); // 🔁 Mulai transaksi

        try {
            $user = User::findOrFail($id);

            // Jika user adalah penulis, hapus data terkait
            if ($user->role === 'penulis') {
                // Hapus semua chapter dari buku penulis
                foreach ($user->books as $book) {
                    $book->chapters()->delete(); // hapus semua chapter
                    $book->delete();              // lalu hapus bukunya
                }

                // Hapus profil penulis jika ada
                if ($user->profil) {
                    $user->profil->delete();
                }
            }

            // Hapus user (baik penulis atau pembaca biasa)
            $user->delete();

            DB::commit(); // ✅ Sukses, commit perubahan

            return redirect()->route('admin.KelolaPengguna')->with('success', 'Pengguna dan datanya berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack(); // ❌ Gagal, rollback semua

            return redirect()->back()->with('error', 'Gagal menghapus pengguna: ' . $e->getMessage());
        }
    }
}
