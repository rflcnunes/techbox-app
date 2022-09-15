<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;

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
        return $this->post->find($id);
    }

}
