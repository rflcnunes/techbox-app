<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\PostRepositoryInterface;

class PostController extends Controller
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        return $this->postRepository->all();
    }

    public function show($id)
    {
        return $this->postRepository->getById($id);
    }
}
