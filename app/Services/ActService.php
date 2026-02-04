<?php

namespace App\Services;

use App\Models\Act;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class ActService
{
    private RepositoryInterface $actRepository;

    /**
     * ActService constructor.
     * @param RepositoryInterface $actRepository
     */
    public function __construct(RepositoryInterface $actRepository)
    {
        $this->actRepository = $actRepository;
    }

    public function get()
    {
        return $this->actRepository->get();
    }

    public function create(array $request): Act
    {
        return $this->actRepository->create($request);
    }

    public function show($id): Act
    {
        return $this->actRepository->find($id);
    }

    public function update(array $request, $id): Act
    {
        return $this->actRepository->update($id, $request);
    }

    public function delete($id): Act
    {
        return $this->actRepository->delete($id);
    }

    public function restore($id): Act
    {
        return $this->actRepository->restore($id);
    }

    public function forceDelete($id): Act
    {
        return $this->actRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->actRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
