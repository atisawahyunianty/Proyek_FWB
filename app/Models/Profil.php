<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profil extends Model
{
    protected $table = 'profil';

    protected $fillable = [
        'user_id',
        'name',
        'bio',
        'social_media_links',
        'profile_photo',
    ];

    // Relasi ke user (pemilik profil)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
