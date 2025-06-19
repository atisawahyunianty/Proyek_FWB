<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class Pembaca2Controller extends Controller
{
    
public function bukuByPenulis($id)
{
    $penulis = User::findOrFail($id);

    // Ambil semua buku milik penulis ini beserta user dan genres
    $books = $penulis->books()->with(['user', 'genres'])->latest()->get();

    return view('pembaca.pembacaByPenulis', compact('penulis', 'books'));
}



}
