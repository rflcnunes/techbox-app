<?php

namespace App\Http\Repositories\Eloquent;

use App\Models\User;
use App\Http\Repositories\Contracts\UserRepositoryInterface;

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
    
}