<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{

    protected $table = 'post';

    protected $fillable = ['user_id', 'title', 'content', 'description', 'image', 'tags', 'category_id', 'url'];

    public function category()
    {
        // return $this->belongsTo('App\Category', 'id');
        return $this->belongsTo('App\Admin\Category', 'id');
    }

    public function author()
    {
        return $this->belongsTo('App\Admin\User', 'id');
    }
}
