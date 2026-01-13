<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Language extends Model
{
    protected $fillable = ['name', 'slug'];
    public $timestamps = false;

    public function getRouteKeyName() { return 'slug'; }

    public function authors() {
        return $this->hasMany(Author::class);
    }

    public function translators() {
        return $this->hasMany(Translator::class, 'native_language_id');
    }protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        if (empty($model->slug)) {
            $model->slug = \Illuminate\Support\Str::slug($model->name);
        }
    });
}
}