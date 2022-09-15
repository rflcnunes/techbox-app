<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function all()
    {
        return $this->comment->all();
    }

    public function getById($id)
    {
        return $this->comment->find($id)->load('posts');
    }

}
