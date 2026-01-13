<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['title', 'content', 'user_id', 'postable_id', 'postable_type'];

    public function postable() { return $this->morphTo(); }
    
    public function user() { return $this->belongsTo(User::class); }

    public function comments() { return $this->morphMany(Comment::class, 'commentable'); }

    public function likes() { return $this->morphMany(Like::class, 'likeable'); }


}
