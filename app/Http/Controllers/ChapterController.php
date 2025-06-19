<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function create($bookId)
    {
        $book = Book::findOrFail($bookId);
        return view('penulis.tambahChapter', compact('book'));
    }

    public function store(Request $request, $bookId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Chapter::create([
            'book_id' => $bookId,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('penulis.lihatBuku')->with('success', 'Chapter berhasil ditambahkan.');
    }
}
