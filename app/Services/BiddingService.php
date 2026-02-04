<?php

namespace App\Services;

use App\Models\Bidding;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class BiddingService
{
    private RepositoryInterface $biddingRepository;

    /**
     * BiddingService constructor.
     * @param RepositoryInterface $biddingRepository
     */
    public function __construct(RepositoryInterface $biddingRepository)
    {
        $this->biddingRepository = $biddingRepository;
    }

    public function get()
    {
        return $this->biddingRepository->get();
    }

    public function create(array $request): bidding
    {
        return $this->biddingRepository->create($request);
    }

    public function show($id): bidding
    {
        return $this->biddingRepository->find($id);
    }

    public function update(array $request, $id): bidding
    {
        return $this->biddingRepository->update($id, $request);
    }

    public function delete($id): bidding
    {
        return $this->biddingRepository->delete($id);
    }

    public function restore($id): bidding
    {
        return $this->biddingRepository->restore($id);
    }

    public function forceDelete($id): bidding
    {
        return $this->biddingRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->biddingRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
