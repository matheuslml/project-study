<?php

namespace App\Services;

use App\Models\DirectHireItem;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class DirectHireItemService
{
    private RepositoryInterface $DirectHireItemRepository;

    /**
     * DirectHireItemService constructor.
     * @param RepositoryInterface $DirectHireItemRepository
     */
    public function __construct(RepositoryInterface $DirectHireItemRepository)
    {
        $this->DirectHireItemRepository = $DirectHireItemRepository;
    }

    public function get()
    {
        return $this->DirectHireItemRepository->get();
    }

    public function create(array $request): DirectHireItem
    {
        return $this->DirectHireItemRepository->create($request);
    }

    public function show($id): DirectHireItem
    {
        return $this->DirectHireItemRepository->find($id);
    }

    public function update(array $request, $id): DirectHireItem
    {
        return $this->DirectHireItemRepository->update($id, $request);
    }

    public function delete($id): DirectHireItem
    {
        return $this->DirectHireItemRepository->delete($id);
    }

    public function restore($id): DirectHireItem
    {
        return $this->DirectHireItemRepository->restore($id);
    }

    public function forceDelete($id): DirectHireItem
    {
        return $this->DirectHireItemRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->DirectHireItemRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
