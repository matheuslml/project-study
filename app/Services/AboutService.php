<?php

namespace App\Services;

use App\Models\About;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class AboutService
{
    private RepositoryInterface $aboutRepository;

    /**
     * AboutService constructor.
     * @param RepositoryInterface $aboutRepository
     */
    public function __construct(RepositoryInterface $aboutRepository)
    {
        $this->aboutRepository = $aboutRepository;
    }

    public function get()
    {
        return $this->aboutRepository->get();
    }

    public function create(array $request): About
    {
        return $this->aboutRepository->create($request);
    }

    public function show($id): About
    {
        return $this->aboutRepository->find($id);
    }

    public function update(array $request, $id): About
    {
        return $this->aboutRepository->update($id, $request);
    }

    public function delete($id): About
    {
        return $this->aboutRepository->delete($id);
    }

    public function restore($id): About
    {
        return $this->aboutRepository->restore($id);
    }

    public function forceDelete($id): About
    {
        return $this->aboutRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->aboutRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
