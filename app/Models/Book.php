<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Chapter;
use App\Models\Bookmark;
use App\Models\Genre;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'user_id',
        'judul',
        'penulis',
        'isi',
        'cover_image',
    ];

    // Relasi ke penulis buku (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke chapter buku
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    // Relasi ke bookmark (pembaca yang menandai buku ini)
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    // Relasi ke genre (many-to-many)
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genre');
    }
}
