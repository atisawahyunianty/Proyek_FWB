<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Book;  
use App\Models\Review;  
use App\Models\Bookmark;
use App\Models\Profil;  


class Users extends Model
{
    protected $table = 'users';

    protected $fillable = ['username', 'email', 'password', 'role'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class); 
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class); 
    }

    public function profil()
    {
        return $this->hasOne(Profil::class);
    }

}
