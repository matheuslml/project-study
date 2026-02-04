<?php

namespace App\Services;

use App\Models\Copyright;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class CopyrightService
{
    private RepositoryInterface $copyrightRepository;

    /**
     * CopyrightService constructor.
     * @param RepositoryInterface $copyrightRepository
     */
    public function __construct(RepositoryInterface $copyrightRepository)
    {
        $this->copyrightRepository = $copyrightRepository;
    }

    public function get()
    {
        return $this->copyrightRepository->get();
    }

    public function create(array $request): Copyright
    {
        return $this->copyrightRepository->create($request);
    }

    public function show($id): Copyright
    {
        return $this->copyrightRepository->find($id);
    }

    public function update(array $request, $id): Copyright
    {
        return $this->copyrightRepository->update($id, $request);
    }

    public function delete($id): Copyright
    {
        return $this->copyrightRepository->delete($id);
    }

    public function restore($id): Copyright
    {
        return $this->copyrightRepository->restore($id);
    }

    public function forceDelete($id): Copyright
    {
        return $this->copyrightRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->copyrightRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
