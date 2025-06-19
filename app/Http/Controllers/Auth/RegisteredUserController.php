<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Profil;


class RegisteredUserController extends Controller
{
    public function create(): View
{
    return view('auth.register');
}
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name'     => ['required', 'string', 'max:255'],
        'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role'     => $request->role ?? 'pembaca',
    ]);

    // ✅ Buat profil default untuk user
    Profil::create([
        'user_id' => $user->id,
        'name' => $user->name,
        'bio' => '',
        'social_media_links' => '',
        'profile_photo' => null,
    ]);

    event(new Registered($user));
    Auth::login($user);

    $role = $user->role;

    return match ($role) {
        'admin', 'penulis' => redirect()->route('dashboard'),
        default             => redirect()->route('home'),
    };
}

}
