<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class CategoryService
{
    private RepositoryInterface $CategoryRepository;

    /**
     * CategoryService constructor.
     * @param RepositoryInterface $CategoryRepository
     */
    public function __construct(RepositoryInterface $CategoryRepository)
    {
        $this->CategoryRepository = $CategoryRepository;
    }

    public function get()
    {
        return $this->CategoryRepository->get();
    }

    public function create(array $request): Category
    {
        return $this->CategoryRepository->create($request);
    }

    public function show($id): Category
    {
        return $this->CategoryRepository->find($id);
    }

    public function update(array $request, $id): Category
    {
        return $this->CategoryRepository->update($id, $request);
    }

    public function delete($id): Category
    {
        return $this->CategoryRepository->delete($id);
    }

    public function restore($id): Category
    {
        return $this->CategoryRepository->restore($id);
    }

    public function forceDelete($id): Category
    {
        return $this->CategoryRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->CategoryRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
