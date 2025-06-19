<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Support\Facades\Auth;

class PenulisController extends Controller
{
public function profil()
{
    $profil = Profil::where('user_id', auth()->id())->first();
    return view('penulis.profil', compact('profil'));
}


    public function dashboard()
    {
        return view('penulis.dashboardPenulis'); 
        
    }


}

