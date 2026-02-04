<?php

namespace App\Services;

use App\Models\ProjectResponsible;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class ProjectResponsibleService
{
    private RepositoryInterface $projectResponsibleRepository;

    /**
     * ProjectResponsibleService constructor.
     * @param RepositoryInterface $projectResponsibleRepository
     */
    public function __construct(RepositoryInterface $projectResponsibleRepository)
    {
        $this->projectResponsibleRepository = $projectResponsibleRepository;
    }

    public function get()
    {
        return $this->projectResponsibleRepository->get();
    }

    public function create(array $request): ProjectResponsible
    {
        return $this->projectResponsibleRepository->create($request);
    }

    public function show($id): ProjectResponsible
    {
        return $this->projectResponsibleRepository->find($id);
    }

    public function update(array $request, $id): ProjectResponsible
    {
        return $this->projectResponsibleRepository->update($id, $request);
    }

    public function delete($id): ProjectResponsible
    {
        return $this->projectResponsibleRepository->delete($id);
    }

    public function restore($id): ProjectResponsible
    {
        return $this->projectResponsibleRepository->restore($id);
    }

    public function forceDelete($id): ProjectResponsible
    {
        return $this->projectResponsibleRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->projectResponsibleRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
