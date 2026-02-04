<?php

namespace App\Services;

use App\Models\Revenue;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class RevenueService
{
    private RepositoryInterface $RevenueRepository;

    /**
     * RevenueService constructor.
     * @param RepositoryInterface $RevenueRepository
     */
    public function __construct(RepositoryInterface $RevenueRepository)
    {
        $this->RevenueRepository = $RevenueRepository;
    }

    public function get()
    {
        return $this->RevenueRepository->get();
    }

    public function create(array $request): Revenue
    {
        return $this->RevenueRepository->create($request);
    }

    public function show($id): Revenue
    {
        return $this->RevenueRepository->find($id);
    }

    public function update(array $request, $id): Revenue
    {
        return $this->RevenueRepository->update($id, $request);
    }

    public function delete($id): Revenue
    {
        return $this->RevenueRepository->delete($id);
    }

    public function restore($id): Revenue
    {
        return $this->RevenueRepository->restore($id);
    }

    public function forceDelete($id): Revenue
    {
        return $this->RevenueRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->RevenueRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
