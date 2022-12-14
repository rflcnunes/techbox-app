<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all()
    {
        return $this->user->all();
    }

    public function getById($id)
    {
        return $this->user->find($id)->load('posts', 'comments');
    }

    public function create(array $data)
    {
        return $this->user->create($data);
    }

}
