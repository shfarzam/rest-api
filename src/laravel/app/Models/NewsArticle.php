<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = [
        'title',
        'author',
        'text',
        'creation_date',
        'publication_date',
        'expiration_date'
    ];
}
