<?php

namespace App\Services;

use App\Models\TypeAccess;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class TypeAccessService
{
    private RepositoryInterface $TypeAccessRepository;

    /**
     * TypeAccessService constructor.
     * @param RepositoryInterface $TypeAccessRepository
     */
    public function __construct(RepositoryInterface $TypeAccessRepository)
    {
        $this->TypeAccessRepository = $TypeAccessRepository;
    }

    public function get()
    {
        return $this->TypeAccessRepository->get();
    }

    public function create(array $request): TypeAccess
    {
        return $this->TypeAccessRepository->create($request);
    }

    public function show($id): TypeAccess
    {
        return $this->TypeAccessRepository->find($id);
    }

    public function update(array $request, $id): TypeAccess
    {
        return $this->TypeAccessRepository->update($id, $request);
    }

    public function delete($id): TypeAccess
    {
        return $this->TypeAccessRepository->delete($id);
    }

    public function restore($id): TypeAccess
    {
        return $this->TypeAccessRepository->restore($id);
    }

    public function forceDelete($id): TypeAccess
    {
        return $this->TypeAccessRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->TypeAccessRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
