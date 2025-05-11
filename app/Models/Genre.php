<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Book; 

class Genre extends Model
{

    protected $table = 'genres';

    protected $fillable = ['name'];

    public function books()
    {
    return $this->belongsToMany(Book::class, 'book_genre');
    }

}
