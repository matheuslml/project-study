<?php

namespace App\Services;

use App\Models\IndividualPerson;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class IndividualPersonService
{
    private RepositoryInterface $individualPersonRepository;

    /**
     * IndividualPersonService constructor.
     * @param RepositoryInterface $individualPersonRepository
     */
    public function __construct(RepositoryInterface $individualPersonRepository)
    {
        $this->individualPersonRepository = $individualPersonRepository;
    }

    public function get()
    {
        return $this->individualPersonRepository->get();
    }

    public function create(array $request): IndividualPerson
    {
        return $this->individualPersonRepository->create($request);
    }

    public function show($id): IndividualPerson
    {
        return $this->individualPersonRepository->find($id);
    }

    public function update(array $request, $id): IndividualPerson
    {
        return $this->individualPersonRepository->update($id, $request);
    }

    public function delete($id): IndividualPerson
    {
        return $this->individualPersonRepository->delete($id);
    }

    public function restore($id): IndividualPerson
    {
        return $this->individualPersonRepository->restore($id);
    }

    public function forceDelete($id): IndividualPerson
    {
        return $this->individualPersonRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->individualPersonRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
