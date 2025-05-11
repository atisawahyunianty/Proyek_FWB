<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Book; 

class Chapter extends Model
{
    protected $table = 'chapters';

    protected $fillable = ['book_id', 'title', 'content', 'chapter_number'];

    public function book()
    {
        return $this->belongsTo(Book::class); 
    }
}
