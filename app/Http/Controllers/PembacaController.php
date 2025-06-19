<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PembacaController extends Controller
{
   public function home()
{
    $user = Auth::user();
    $profil = $user ? $user->profil : null;

    return view('welcome', compact('profil'));
}

}

