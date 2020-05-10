<?php

namespace App;

use App\Post;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
