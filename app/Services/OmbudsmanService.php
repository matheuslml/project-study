<?php

namespace App\Services;

use App\Models\Ombudsman;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class OmbudsmanService
{
    private RepositoryInterface $OmbudsmanRepository;

    /**
     * OmbudsmanService constructor.
     * @param RepositoryInterface $OmbudsmanRepository
     */
    public function __construct(RepositoryInterface $OmbudsmanRepository)
    {
        $this->OmbudsmanRepository = $OmbudsmanRepository;
    }

    public function get()
    {
        return $this->OmbudsmanRepository->get();
    }

    public function create(array $request): Ombudsman
    {
        return $this->OmbudsmanRepository->create($request);
    }

    public function show($id): Ombudsman
    {
        return $this->OmbudsmanRepository->find($id);
    }

    public function update(array $request, $id): Ombudsman
    {
        return $this->OmbudsmanRepository->update($id, $request);
    }

    public function delete($id): Ombudsman
    {
        return $this->OmbudsmanRepository->delete($id);
    }

    public function restore($id): Ombudsman
    {
        return $this->OmbudsmanRepository->restore($id);
    }

    public function forceDelete($id): Ombudsman
    {
        return $this->OmbudsmanRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->OmbudsmanRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
