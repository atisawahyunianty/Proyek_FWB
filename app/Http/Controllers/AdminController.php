<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    ///BUKUUUU

    // Menampilkan semua buku
    public function kelolaBuku()
    {
        $books = Book::with('user')->latest()->get();
        return view('admin.KelolaBuku', compact('books'));
    }
    //Menghapus buku
    public function hapusBuku($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return back()->with('success', 'Buku berhasil dihapus oleh admin.');
    }

}
