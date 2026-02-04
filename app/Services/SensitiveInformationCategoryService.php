<?php

namespace App\Services;

use App\Models\SensitiveInformationCategory;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class SensitiveInformationCategoryService
{
    private RepositoryInterface $projectCategoryRepository;

    /**
     * ProjectCategoryService constructor.
     * @param RepositoryInterface $projectCategoryRepository
     */
    public function __construct(RepositoryInterface $projectCategoryRepository)
    {
        $this->projectCategoryRepository = $projectCategoryRepository;
    }

    public function get()
    {
        return $this->projectCategoryRepository->get();
    }

    public function create(array $request): SensitiveInformationCategory
    {
        return $this->projectCategoryRepository->create($request);
    }

    public function show($id): SensitiveInformationCategory
    {
        return $this->projectCategoryRepository->find($id);
    }

    public function update(array $request, $id): SensitiveInformationCategory
    {
        return $this->projectCategoryRepository->update($id, $request);
    }

    public function delete($id): SensitiveInformationCategory
    {
        return $this->projectCategoryRepository->delete($id);
    }

    public function restore($id): SensitiveInformationCategory
    {
        return $this->projectCategoryRepository->restore($id);
    }

    public function forceDelete($id): SensitiveInformationCategory
    {
        return $this->projectCategoryRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->projectCategoryRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
