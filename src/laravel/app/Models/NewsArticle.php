<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    use HasFactory;

    protected $table = 'news_articles';

    protected $dates = ['creation_date','publication_date','expiration_date'];

    protected $hidden = ['created_at','updated_at'];

    protected $fillable = [
        'title',
        'author',
        'text',
        'creation_date',
        'publication_date',
        'expiration_date'
    ];
}
