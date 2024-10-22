<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name',
        'author',
        'isbn',
        'page_number',
        'publisher',
        'year_published',
        'file',
        'image'
    ];

    
}
