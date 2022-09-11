<?php

namespace App\Http\Repositories\Eloquent;

use App\Models\Post;
use App\Http\Repositories\Contracts\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function all()
    {
        return $this->post->all();
    }

    public function getById($id)
    {
        return $this->post->find($id)->load('users', 'comments');
    }
    
}