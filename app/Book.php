<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['name', 'author', 'category_id', 'published_date', 'user_id'];

}
