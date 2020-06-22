<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class PostCategory extends Model
{
    protected $table = 'post_categories';

    protected $fillable = ['name'];

    public function posts(){
        return $this->hasMany("Post");
    }
}
