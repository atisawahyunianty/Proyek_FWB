<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterPembacaController extends Controller
{
    public function index($id)
{
    $buku = Book::with('chapters')->findOrFail($id);
    return view('pembaca.pembacaLihatChapter', compact('buku'));
}

public function show($id)
{
    $chapter = Chapter::findOrFail($id);
    return view('pembaca.chapterDetail', compact('chapter'));
}

}
