<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{

    use SoftDeletes;

    protected $table = 'post';

    protected $fillable = ['user_id', 'title', 'content', 'description', 'image', 'tags', 'category_id', 'url'];

    public function category()
    {
        return $this->belongsTo('App\Category', 'id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
