<?php

namespace App\Services;

use App\Models\LegislationSubject;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class LegislationSubjectService
{
    private RepositoryInterface $legislationSubjectRepository;

    /**
     * LegislationSubjectService constructor.
     * @param RepositoryInterface $legislationSubjectRepository
     */
    public function __construct(RepositoryInterface $legislationSubjectRepository)
    {
        $this->legislationSubjectRepository = $legislationSubjectRepository;
    }

    public function get()
    {
        return $this->legislationSubjectRepository->get();
    }

    public function create(array $request): LegislationSubject
    {
        return $this->legislationSubjectRepository->create($request);
    }

    public function show($id): LegislationSubject
    {
        return $this->legislationSubjectRepository->find($id);
    }

    public function update(array $request, $id): LegislationSubject
    {
        return $this->legislationSubjectRepository->update($id, $request);
    }

    public function delete($id): LegislationSubject
    {
        return $this->legislationSubjectRepository->delete($id);
    }

    public function restore($id): LegislationSubject
    {
        return $this->legislationSubjectRepository->restore($id);
    }

    public function forceDelete($id): LegislationSubject
    {
        return $this->legislationSubjectRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->legislationSubjectRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
