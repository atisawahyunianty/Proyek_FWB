<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth; // ✅ Tetap pakai ini
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index()
    {
        $bookmarks = Auth::user()->bookmarks()->with('book')->get();
        return view('pembaca.bookmark', compact('bookmarks'));
    }

    public function store($bookId)
    {
        Bookmark::firstOrCreate([
            'user_id' => Auth::id(),
            'book_id' => $bookId
        ]);

        return back()->with('success', 'Buku ditambahkan ke daftar bacaan!');
    }

    public function destroy($bookId)
    {
        Bookmark::where('user_id', Auth::id())
                ->where('book_id', $bookId)
                ->delete();

        return back()->with('success', 'Buku dihapus dari daftar bacaan.');
    }
}
