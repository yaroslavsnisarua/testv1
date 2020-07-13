<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
	 use SoftDeletes;
    protected $table = 'comments';

    protected $fillable = [

		'post_id',
		'commentator_id',
		'content',


    ];


    public function post()
    {
        return $this->hasOne('App\Post', 'id', 'post_id');
    }

    public function author()
    {
        return $this->hasOne('App\User', 'id', 'commentator_id');
    }


}
