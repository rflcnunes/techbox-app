<?php

namespace App\Http\Repositories\Contracts;

interface PostRepositoryInterface
{
    public function all();
    public function getById($id);
}