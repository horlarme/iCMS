<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Category;

class Posts extends Model
{

	protected $table = 'post';

	public function category(){
		// return $this->belongsTo('App\Category', 'id');
		return $this->belongsTo('App\Admin\Category', 'id');
	}

	public function author(){
		return $this->belongsTo('App\Admin\User', 'id');
	}
}
