<?php

namespace App\Services;

use App\Models\LegislationCategory;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class LegislationCategoryService
{
    private RepositoryInterface $legislationCategoryRepository;

    /**
     * LegislationCategoryService constructor.
     * @param RepositoryInterface $legislationCategoryRepository
     */
    public function __construct(RepositoryInterface $legislationCategoryRepository)
    {
        $this->legislationCategoryRepository = $legislationCategoryRepository;
    }

    public function get()
    {
        return $this->legislationCategoryRepository->get();
    }

    public function create(array $request): LegislationCategory
    {
        return $this->legislationCategoryRepository->create($request);
    }

    public function show($id): LegislationCategory
    {
        return $this->legislationCategoryRepository->find($id);
    }

    public function update(array $request, $id): LegislationCategory
    {
        return $this->legislationCategoryRepository->update($id, $request);
    }

    public function delete($id): LegislationCategory
    {
        return $this->legislationCategoryRepository->delete($id);
    }

    public function restore($id): LegislationCategory
    {
        return $this->legislationCategoryRepository->restore($id);
    }

    public function forceDelete($id): LegislationCategory
    {
        return $this->legislationCategoryRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->legislationCategoryRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
