<?php

namespace App\Services;

use App\Models\DirectHireWinner;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class DirectHireWinnerService
{
    private RepositoryInterface $DirectHireWinnerRepository;

    /**
     * DirectHireWinnerService constructor.
     * @param RepositoryInterface $DirectHireWinnerRepository
     */
    public function __construct(RepositoryInterface $DirectHireWinnerRepository)
    {
        $this->DirectHireWinnerRepository = $DirectHireWinnerRepository;
    }

    public function get()
    {
        return $this->DirectHireWinnerRepository->get();
    }

    public function create(array $request): DirectHireWinner
    {
        return $this->DirectHireWinnerRepository->create($request);
    }

    public function show($id): DirectHireWinner
    {
        return $this->DirectHireWinnerRepository->find($id);
    }

    public function update(array $request, $id): DirectHireWinner
    {
        return $this->DirectHireWinnerRepository->update($id, $request);
    }

    public function delete($id): DirectHireWinner
    {
        return $this->DirectHireWinnerRepository->delete($id);
    }

    public function restore($id): DirectHireWinner
    {
        return $this->DirectHireWinnerRepository->restore($id);
    }

    public function forceDelete($id): DirectHireWinner
    {
        return $this->DirectHireWinnerRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->DirectHireWinnerRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
