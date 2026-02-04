<?php

namespace App\Services;

use App\Models\DirectHire;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class DirectHireService
{
    private RepositoryInterface $directHireRepository;

    /**
     * DirectHireService constructor.
     * @param RepositoryInterface $directHireRepository
     */
    public function __construct(RepositoryInterface $directHireRepository)
    {
        $this->directHireRepository = $directHireRepository;
    }

    public function get()
    {
        return $this->directHireRepository->get();
    }

    public function create(array $request): DirectHire
    {
        return $this->directHireRepository->create($request);
    }

    public function show($id): DirectHire
    {
        return $this->directHireRepository->find($id);
    }

    public function update(array $request, $id): DirectHire
    {
        return $this->directHireRepository->update($id, $request);
    }

    public function delete($id): DirectHire
    {
        return $this->directHireRepository->delete($id);
    }

    public function restore($id): DirectHire
    {
        return $this->directHireRepository->restore($id);
    }

    public function forceDelete($id): DirectHire
    {
        return $this->directHireRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->directHireRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
