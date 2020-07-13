<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model
{
	 use SoftDeletes;
    

	protected $table = 'posts';

    protected $fillable = [

		'author_id',
		'image_id',
		'content',


    ];



public function author()
    {
        return $this->hasOne('App\User', 'id', 'author_id');
    }

public function image()
    {
        return $this->hasOne('App\Image', 'id', 'image_id');
    }


public function comments()
    {
        return $this->hasMany('App\Comment', 'post_id', 'id');
    }

}
