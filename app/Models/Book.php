<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;  
use App\Models\Chapter;  
use App\Models\Review;  
use App\Models\Bookmark;  
use App\Models\Genre;  

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = ['user_id', 'title', 'description', 'cover_image', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class); 
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class); 
    }

    public function reviews()
    {
        return $this->hasMany(Review::class); 
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class); 
    }

    public function genres()
    {
    return $this->belongsToMany(Genre::class, 'book_genre'); 
    }

}
