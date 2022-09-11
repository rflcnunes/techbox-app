<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the comment.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'comment_user')->withPivot('comment_id', 'user_id');
    }

    /**
     * Get the post that owns the comment.
     */

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'comment_post')->withPivot('comment_id', 'post_id');
    }
}
