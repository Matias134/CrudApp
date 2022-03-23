<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image', 'number_of_pages', 'year_of_publication', 'author_id'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
