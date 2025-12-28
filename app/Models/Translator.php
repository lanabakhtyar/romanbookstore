<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translator extends Model
{
    //

    use HasFactory;

    protected $table ='translators';
    protected $fillable =['name','native_language_id'];



    //each translator is associated with many books
       public function books()
    {
        return $this->hasMany(Book::class);
    }


    //each translator had one native tongue 
    public function language(){
        return $this->belongsTo(Language::class, 'native_language_id');
    }
}
