<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table = 'pages';

    public function user()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
