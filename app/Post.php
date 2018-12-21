<?php

namespace lsapp;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //table name
    protected $table = 'posts';

    //Primary key

    public $primaryKey = 'id';

    //Timestamps

    public $timestamps = true;

    public function user(){
        return $this->belongsTo('lsapp\User');

    }
}
