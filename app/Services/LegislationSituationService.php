<?php

namespace App\Services;

use App\Models\LegislationSituation;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class LegislationSituationService
{
    private RepositoryInterface $legislationSituationRepository;

    /**
     * LegislationSituationService constructor.
     * @param RepositoryInterface $legislationSituationRepository
     */
    public function __construct(RepositoryInterface $legislationSituationRepository)
    {
        $this->legislationSituationRepository = $legislationSituationRepository;
    }

    public function get()
    {
        return $this->legislationSituationRepository->get();
    }

    public function create(array $request): LegislationSituation
    {
        return $this->legislationSituationRepository->create($request);
    }

    public function show($id): LegislationSituation
    {
        return $this->legislationSituationRepository->find($id);
    }

    public function update(array $request, $id): LegislationSituation
    {
        return $this->legislationSituationRepository->update($id, $request);
    }

    public function delete($id): LegislationSituation
    {
        return $this->legislationSituationRepository->delete($id);
    }

    public function restore($id): LegislationSituation
    {
        return $this->legislationSituationRepository->restore($id);
    }

    public function forceDelete($id): LegislationSituation
    {
        return $this->legislationSituationRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->legislationSituationRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
