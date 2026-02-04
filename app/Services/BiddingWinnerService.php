<?php

namespace App\Services;

use App\Models\BiddingWinner;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class BiddingWinnerService
{
    private RepositoryInterface $biddingWinnerRepository;

    /**
     * BiddingWinnerService constructor.
     * @param RepositoryInterface $biddingWinnerRepository
     */
    public function __construct(RepositoryInterface $biddingWinnerRepository)
    {
        $this->biddingWinnerRepository = $biddingWinnerRepository;
    }

    public function get()
    {
        return $this->biddingWinnerRepository->get();
    }

    public function create(array $request): BiddingWinner
    {
        return $this->biddingWinnerRepository->create($request);
    }

    public function show($id): BiddingWinner
    {
        return $this->biddingWinnerRepository->find($id);
    }

    public function update(array $request, $id): BiddingWinner
    {
        return $this->biddingWinnerRepository->update($id, $request);
    }

    public function delete($id): BiddingWinner
    {
        return $this->biddingWinnerRepository->delete($id);
    }

    public function restore($id): BiddingWinner
    {
        return $this->biddingWinnerRepository->restore($id);
    }

    public function forceDelete($id): BiddingWinner
    {
        return $this->biddingWinnerRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->biddingWinnerRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
