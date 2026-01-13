<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translator extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory;

    protected $fillable = ['name', 'slug', 'native_language_id'];

    public function getRouteKeyName() { return 'slug'; }

    // Register media for a profile photo if needed
    public function registerMediaCollections(): void {
        $this->addMediaCollection('avatar')->singleFile();
    }

    public function language() {
        return $this->belongsTo(Language::class, 'native_language_id');
    }

    public function books() {
        return $this->hasMany(Book::class);
    }
}