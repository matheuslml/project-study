<?php

namespace App\Services;

use App\Models\SensitiveInformation;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class SensitiveInformationService
{
    private RepositoryInterface $projectRepository;

    /**
     * ProjectService constructor.
     * @param RepositoryInterface $projectRepository
     */
    public function __construct(RepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function get()
    {
        return $this->projectRepository->get();
    }

    public function create(array $request): SensitiveInformation
    {
        return $this->projectRepository->create($request);
    }

    public function show($id): SensitiveInformation
    {
        return $this->projectRepository->find($id);
    }

    public function update(array $request, $id): SensitiveInformation
    {
        return $this->projectRepository->update($id, $request);
    }

    public function delete($id): SensitiveInformation
    {
        return $this->projectRepository->delete($id);
    }

    public function restore($id): SensitiveInformation
    {
        return $this->projectRepository->restore($id);
    }

    public function forceDelete($id): SensitiveInformation
    {
        return $this->projectRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->projectRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
