<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\BukuPembacaController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ChapterPembacaController;
use App\Http\Controllers\Pembaca2Controller;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\PembacaController;
use App\Http\Controllers\PenulisProfilController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProfileController;
use App\Models\Profil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [PembacaController::class, 'home'])->name('home');

// Admin dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return app(AdminController::class)->dashboard();
        }

        if ($user->role === 'penulis') {
            return app(PenulisController::class)->dashboard();
        }

        return redirect()->route('home');
    })->name('dashboard');

    // Route profile tetap
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profilpembaca.edit');
    Route::patch('/profil/update', [ProfilController::class, 'update'])->name('profilpembaca.update');


    Route::get('/penulis/profil', [PenulisController::class, 'profil'])->name('penulis.profil');
     Route::get('/penulis/profil/edit', [PenulisProfilController::class, 'editProfil'])->name('penulis.editProfil');
     Route::patch('/penulis/profil/update', [PenulisProfilController::class, 'updateProfil'])->name('penulis.updateProfil');

});



//PENULIS

Route::middleware(['auth'])->group(function () {
    Route::get('penulis/buku', [BukuController::class, 'lihatBuku'])->name('penulis.lihatBuku');
    Route::get('/buku/create', [BukuController::class, 'create'])->name('penulis.tambahBuku');
    Route::post('/buku', [BukuController::class, 'store'])->name('penulis.store');
    Route::get('/books/{id}', [BukuController::class, 'show'])->name('books.show');
    Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('penulis.editBuku');
    Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('penulis.destroy');
    Route::put('/buku/{id}', [BukuController::class, 'update'])->name('penulis.update');
    Route::get('/chapter/{id}/edit', [BukuController::class, 'edit'])->name('chapter.edit');
    Route::get('/penulis/buku/{id}/chapter/create', [ChapterController::class, 'create'])->name('penulis.tambahChapter');
    Route::post('/penulis/buku/{id}/chapter', [ChapterController::class, 'store'])->name('penulis.storeChapter');


});

Route::get('/dashboard/penulis', function () {
    return view('penulis.beranda'); // arahkan ke view yang kita atur tadi
})->middleware(['auth', 'verified'])->name('penulis.beranda');



Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.KelolaPengguna');
    Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.destroy');
});

// Route untuk ADMIN
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Kelola Buku
    Route::get('/admin/kelola-buku', [AdminController::class, 'kelolaBuku'])->name('admin.KelolaBuku');
    Route::delete('/admin/buku/{id}', [AdminController::class, 'hapusBuku'])->name('admin.hapusBuku');

    // Kelola Pengguna
    Route::get('/admin/kelola-pengguna', [AdminUserController::class, 'index'])->name('admin.KelolaPengguna');
    Route::delete('/admin/kelola-pengguna/{id}', [AdminUserController::class, 'destroy'])->name('admin.hapusPengguna');
});

// PEMBACA
Route::get('/buku', [BukuPembacaController::class, 'index'])->name('pembaca.pembacaLihatBuku');
Route::get('/buku/{id}/chapter', [ChapterPembacaController::class, 'index'])->name('pembaca.pembacaLihatChapter');
Route::get('/buku/{book}/chapter/{chapter}', [BukuPembacaController::class, 'showChapter'])->name('pembaca.chapter.show');
Route::get('/chapter/{id}', [ChapterPembacaController::class, 'show'])->name('pembaca.chapterDetail');

Route::middleware(['auth'])->group(function () {
    Route::post('/bookmark/{id}', [BookmarkController::class, 'store'])->name('pembaca.bookmark.store');
    Route::delete('/bookmark/{id}', [BookmarkController::class, 'destroy'])->name('pembaca.bookmark.destroy');
    Route::get('/bookmark', [BookmarkController::class, 'index'])->name('pembaca.bookmark');
    
});

Route::get('/penulis/{id}', [Pembaca2Controller::class, 'bukuByPenulis'])->name('pembaca.pembacaByPenulis');
Route::get('/penulis', [PembacaController::class, 'daftarPenulis'])->name('pembaca.daftarPenulis');



require __DIR__.'/auth.php';
