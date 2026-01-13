<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Author extends Model implements HasMedia // Changed to Singular
{
    use InteractsWithMedia, HasFactory; 
    
    protected $fillable = ['name', 'slug','language_id', 'bio'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile(); 
    }



    public function language()
    {
        // Removed the custom key so it defaults to language_id
        return $this->belongsTo(Language::class);
    }
    // Tell Laravel to use the slug for URLs instead of the ID
    public function getRouteKeyName()
    {
        return 'slug';

    }protected static function boot()


    {
    parent::boot();

    static::creating(function ($model) {
        if (empty($model->slug)) {
            $model->slug = \Illuminate\Support\Str::slug($model->name);
        }
    });
}

public function books()
{
    return $this->belongsToMany(Book::class); // Changed from hasMany to belongsToMany
}
}