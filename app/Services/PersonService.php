<?php

namespace App\Services;

use App\Models\Person;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class PersonService
{
    private RepositoryInterface $personRepository;

    /**
     * PersonService constructor.
     * @param RepositoryInterface $personRepository
     */
    public function __construct(RepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function get()
    {
        return $this->personRepository->get();
    }

    public function create(array $request): Person
    {
        return $this->personRepository->create($request);
    }

    public function show($id): Person
    {
        return $this->personRepository->find($id);
    }

    public function update(array $request, $id): Person
    {
        return $this->personRepository->update($id, $request);
    }

    public function delete($id): Person
    {
        return $this->personRepository->delete($id);
    }

    public function restore($id): Person
    {
        return $this->personRepository->restore($id);
    }

    public function forceDelete($id): Person
    {
        return $this->personRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->personRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
