<?php

namespace App\Http\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function all();
    public function getById($id);
    public function create(array $data);
}