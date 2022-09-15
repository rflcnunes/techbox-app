<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function index()
    {
        return $this->commentRepository->all();
    }

    public function show($id)
    {
        return $this->commentRepository->getById($id);
    }
}
