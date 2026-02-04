<?php

namespace App\Services;

use App\Models\LegislationBond;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class LegislationBondService
{
    private RepositoryInterface $legislationBondRepository;

    /**
     * LegislationBondService constructor.
     * @param RepositoryInterface $legislationBondRepository
     */
    public function __construct(RepositoryInterface $legislationBondRepository)
    {
        $this->legislationBondRepository = $legislationBondRepository;
    }

    public function get()
    {
        return $this->legislationBondRepository->get();
    }

    public function create(array $request): LegislationBond
    {
        return $this->legislationBondRepository->create($request);
    }

    public function show($id): LegislationBond
    {
        return $this->legislationBondRepository->find($id);
    }

    public function update(array $request, $id): LegislationBond
    {
        return $this->legislationBondRepository->update($id, $request);
    }

    public function delete($id): LegislationBond
    {
        return $this->legislationBondRepository->delete($id);
    }

    public function restore($id): LegislationBond
    {
        return $this->legislationBondRepository->restore($id);
    }

    public function forceDelete($id): LegislationBond
    {
        return $this->legislationBondRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->legislationBondRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
