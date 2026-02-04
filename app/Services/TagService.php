<?php

namespace App\Services;

use App\Models\Tag;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class TagService
{
    private RepositoryInterface $TagRepository;

    /**
     * TagService constructor.
     * @param RepositoryInterface $TagRepository
     */
    public function __construct(RepositoryInterface $TagRepository)
    {
        $this->TagRepository = $TagRepository;
    }

    public function get()
    {
        return $this->TagRepository->get();
    }

    public function create(array $request): Tag
    {
        return $this->TagRepository->create($request);
    }

    public function show($id): Tag
    {
        return $this->TagRepository->find($id);
    }

    public function update(array $request, $id): Tag
    {
        return $this->TagRepository->update($id, $request);
    }

    public function delete($id): Tag
    {
        return $this->TagRepository->delete($id);
    }

    public function restore($id): Tag
    {
        return $this->TagRepository->restore($id);
    }

    public function forceDelete($id): Tag
    {
        return $this->TagRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->TagRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
