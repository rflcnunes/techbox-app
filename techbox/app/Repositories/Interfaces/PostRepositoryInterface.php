<?php

namespace App\Repositories\Interfaces;

interface PostRepositoryInterface
{
    public function all();
    public function getById($id);
}
