<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the post.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'post_user')->withPivot('post_id', 'user_id');
    }

    /**
     * Get the comments for the post.
     */

    public function comments()
    {
        return $this->belongsToMany(Comment::class, 'comment_post')->withPivot('post_id', 'comment_id');
    }
}
