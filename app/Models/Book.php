<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public $timestamps= false;

    protected $fillable = [
      'title',
      'author',
      'genre',
      'description',
      'isbn',
      'image',
      'published',
      'publisher'
    ];

    /**
     * Return file storage path
     * @param $value
     * @return string
     */
    public function getImageAttribute($value){
        return asset('storage/'.$value);
    }


}
