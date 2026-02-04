<?php

namespace App\Services;

use App\Models\Legislation;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class LegislationService
{
    private RepositoryInterface $legislationRepository;

    /**
     * LegislationService constructor.
     * @param RepositoryInterface $legislationRepository
     */
    public function __construct(RepositoryInterface $legislationRepository)
    {
        $this->legislationRepository = $legislationRepository;
    }

    public function get()
    {
        return $this->legislationRepository->get();
    }

    public function create(array $request): Legislation
    {
        return $this->legislationRepository->create($request);
    }

    public function show($id): Legislation
    {
        return $this->legislationRepository->find($id);
    }

    public function update(array $request, $id): Legislation
    {
        return $this->legislationRepository->update($id, $request);
    }

    public function delete($id): Legislation
    {
        return $this->legislationRepository->delete($id);
    }

    public function restore($id): Legislation
    {
        return $this->legislationRepository->restore($id);
    }

    public function forceDelete($id): Legislation
    {
        return $this->legislationRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->legislationRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
