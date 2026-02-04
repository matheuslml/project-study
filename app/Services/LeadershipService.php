<?php

namespace App\Services;

use App\Models\Leadership;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class LeadershipService
{
    private RepositoryInterface $leadershipRepository;

    /**
     * LeadershipService constructor.
     * @param RepositoryInterface $leadershipRepository
     */
    public function __construct(RepositoryInterface $leadershipRepository)
    {
        $this->leadershipRepository = $leadershipRepository;
    }

    public function get()
    {
        return $this->leadershipRepository->get();
    }

    public function create(array $request): Leadership
    {
        return $this->leadershipRepository->create($request);
    }

    public function show($id): Leadership
    {
        return $this->leadershipRepository->find($id);
    }

    public function update(array $request, $id): Leadership
    {
        return $this->leadershipRepository->update($id, $request);
    }

    public function delete($id): Leadership
    {
        return $this->leadershipRepository->delete($id);
    }

    public function restore($id): Leadership
    {
        return $this->leadershipRepository->restore($id);
    }

    public function forceDelete($id): Leadership
    {
        return $this->leadershipRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->leadershipRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
