<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class PostService
{
    private RepositoryInterface $postRepository;

    /**
     * PostService constructor.
     * @param RepositoryInterface $postRepository
     */
    public function __construct(RepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function get()
    {
        return $this->postRepository->get();
    }

    public function create(array $request): Post
    {
        return $this->postRepository->create($request);
    }

    public function show($id): Post
    {
        return $this->postRepository->find($id);
    }

    public function update(array $request, $id): Post
    {
        return $this->postRepository->update($id, $request);
    }

    public function delete($id): Post
    {
        return $this->postRepository->delete($id);
    }

    public function restore($id): Post
    {
        return $this->postRepository->restore($id);
    }

    public function forceDelete($id): Post
    {
        return $this->postRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->postRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
