<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'body',
    ];

    public function comments(){
        return $this->hasMany(\App\Models\Comment::class);
    }

    public function set_best_comment($comment){
        $this->best_comment_id = $comment->id;
        return $this->save();
    }
}
