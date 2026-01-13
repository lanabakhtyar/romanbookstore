<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    use InteractsWithMedia;

    protected $fillable = ['title', 'slug', 'description', 'price', 'language_id', 'stock_count'];

    protected static function boot()
    {
        parent::boot();
        static::creating(fn($book) => $book->slug = Str::slug($book->title));
    }

    // Relationships
    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function translators()
    {
        return $this->belongsToMany(Translator::class);
    }

    // Phase 3: Polymorphic Content
    public function posts()
    {
        return $this->morphMany(Post::class, 'postable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }


}
