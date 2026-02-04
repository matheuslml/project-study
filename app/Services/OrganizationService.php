<?php

namespace App\Services;

use App\Models\Organization;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class OrganizationService
{
    private RepositoryInterface $organizationRepository;

    /**
     * OrganizationService constructor.
     * @param RepositoryInterface $organizationRepository
     */
    public function __construct(RepositoryInterface $organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
    }

    public function get()
    {
        return $this->organizationRepository->get();
    }

    public function create(array $request): Organization
    {
        return $this->organizationRepository->create($request);
    }

    public function show($id): Organization
    {
        return $this->organizationRepository->find($id);
    }

    public function update(array $request, $id): Organization
    {
        return $this->organizationRepository->update($id, $request);
    }

    public function delete($id): Organization
    {
        return $this->organizationRepository->delete($id);
    }

    public function restore($id): Organization
    {
        return $this->organizationRepository->restore($id);
    }

    public function forceDelete($id): Organization
    {
        return $this->organizationRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->organizationRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
