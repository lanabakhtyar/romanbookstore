<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Language extends Model
{
    protected $fillable = ['name'];

    public $timestamps = false;

    // Each language has many books
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
