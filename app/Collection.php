<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table = 'collections';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\User','user');
    }

    public function books() {
        return $this->belongsToMany('App\Book','book_collection','collection','book');
    }
}
