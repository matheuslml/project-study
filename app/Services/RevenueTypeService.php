<?php

namespace App\Services;

use App\Models\RevenueType;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class RevenueTypeService
{
    private RepositoryInterface $RevenueTypeRepository;

    /**
     * RevenueTypeService constructor.
     * @param RepositoryInterface $RevenueTypeRepository
     */
    public function __construct(RepositoryInterface $RevenueTypeRepository)
    {
        $this->RevenueTypeRepository = $RevenueTypeRepository;
    }

    public function get()
    {
        return $this->RevenueTypeRepository->get();
    }

    public function create(array $request): RevenueType
    {
        return $this->RevenueTypeRepository->create($request);
    }

    public function show($id): RevenueType
    {
        return $this->RevenueTypeRepository->find($id);
    }

    public function update(array $request, $id): RevenueType
    {
        return $this->RevenueTypeRepository->update($id, $request);
    }

    public function delete($id): RevenueType
    {
        return $this->RevenueTypeRepository->delete($id);
    }

    public function restore($id): RevenueType
    {
        return $this->RevenueTypeRepository->restore($id);
    }

    public function forceDelete($id): RevenueType
    {
        return $this->RevenueTypeRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->RevenueTypeRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
