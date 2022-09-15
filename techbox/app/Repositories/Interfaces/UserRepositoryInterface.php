<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function all();
    public function getById($id);
    public function create(array $data);
}
