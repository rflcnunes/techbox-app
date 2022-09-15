<?php

namespace App\Repositories\Interfaces;

interface CommentRepositoryInterface
{
    public function all();
    public function getById($id);
}
