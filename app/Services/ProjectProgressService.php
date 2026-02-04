<?php

namespace App\Services;

use App\Models\ProjectProgress;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class ProjectProgressService
{
    private RepositoryInterface $projectProgressRepository;

    /**
     * ProjectProgressService constructor.
     * @param RepositoryInterface $projectProgressRepository
     */
    public function __construct(RepositoryInterface $projectProgressRepository)
    {
        $this->projectProgressRepository = $projectProgressRepository;
    }

    public function get()
    {
        return $this->projectProgressRepository->get();
    }

    public function create(array $request): ProjectProgress
    {
        return $this->projectProgressRepository->create($request);
    }

    public function show($id): ProjectProgress
    {
        return $this->projectProgressRepository->find($id);
    }

    public function update(array $request, $id): ProjectProgress
    {
        return $this->projectProgressRepository->update($id, $request);
    }

    public function delete($id): ProjectProgress
    {
        return $this->projectProgressRepository->delete($id);
    }

    public function restore($id): ProjectProgress
    {
        return $this->projectProgressRepository->restore($id);
    }

    public function forceDelete($id): ProjectProgress
    {
        return $this->projectProgressRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->projectProgressRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
