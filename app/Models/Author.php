<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';
    protected $fillable = ['name', 'country'];

    public function publishers()
    {
        return $this->belongsToMany(Publisher::class, 'author_publisher', 'author_id', 'publisher_id');
    }

}