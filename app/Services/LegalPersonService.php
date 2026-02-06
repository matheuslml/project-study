<?php

namespace App\Services;

use App\Models\LegalPerson;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class LegalPersonService
{
    private RepositoryInterface $legalPersonRepository;

    /**
     * LegalPersonService constructor.
     * @param RepositoryInterface $legalPersonRepository
     */
    public function __construct(RepositoryInterface $legalPersonRepository)
    {
        $this->legalPersonRepository = $legalPersonRepository;
    }

    public function get()
    {
        return $this->legalPersonRepository->get();
    }

    public function create(array $request): LegalPerson
    {
        return $this->legalPersonRepository->create($request);
    }

    public function show($id): LegalPerson
    {
        return $this->legalPersonRepository->find($id);
    }

    public function update(array $request, $id): LegalPerson
    {
        return $this->legalPersonRepository->update($id, $request);
    }

    public function delete($id): LegalPerson
    {
        return $this->legalPersonRepository->delete($id);
    }

    public function restore($id): LegalPerson
    {
        return $this->legalPersonRepository->restore($id);
    }

    public function forceDelete($id): LegalPerson
    {
        return $this->legalPersonRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->legalPersonRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
