<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function collections() {
        $this->belongsToMany('App\Collection','book_collection','book','collection');
    }
}
