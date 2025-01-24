<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table = 'publishers';
    protected $fillable = ['name', 'country'];

    // Relación con autores (Muchos a Muchos)
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_publisher', 'publisher_id', 'author_id');
    }
}
