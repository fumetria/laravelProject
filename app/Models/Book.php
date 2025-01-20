<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use App\Models\Loan;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $fillable = ['isbn', 'title', 'genre', 'publisher', 'author_id'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
