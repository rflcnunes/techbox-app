<?php

namespace App\Http\Repositories\Contracts;

interface CommentRepositoryInterface
{
    public function all();
    public function getById($id);
}