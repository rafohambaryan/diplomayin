<?php

namespace App\Http\Controllers\Backend;

use App\Repository\Backend\Interfaces\MainSlideRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainSlideController extends Controller
{
    protected $repository;

    public function __construct(MainSlideRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function update(Request $request)
    {
        return response()->json($this->repository->update($request), 201);
    }
}
