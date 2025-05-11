<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Book; 
use App\Models\User; 

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = ['book_id', 'user_id', 'review_text'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class); 
    }
}
