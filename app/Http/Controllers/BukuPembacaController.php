<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BukuPembacaController extends Controller
{
    public function index()
{
    $books = Book::with(['user', 'genres'])->latest()->get();
    return view('pembaca.pembacaLihatBuku', compact('books'));
}

public function showChapter($bookId, $chapterId)
{
    $book = Book::findOrFail($bookId);
    $chapter = $book->chapters()->where('id', $chapterId)->firstOrFail();

    return view('pembaca.chapter_show', compact('book', 'chapter'));
}

}
