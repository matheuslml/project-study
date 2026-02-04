<?php

namespace App\Services;

use App\Models\BiddingArea;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class BiddingAreaService
{
    private RepositoryInterface $biddingAreaRepository;

    /**
     * BiddingAreaService constructor.
     * @param RepositoryInterface $biddingAreaRepository
     */
    public function __construct(RepositoryInterface $biddingAreaRepository)
    {
        $this->biddingAreaRepository = $biddingAreaRepository;
    }

    public function get()
    {
        return $this->biddingAreaRepository->get();
    }

    public function create(array $request): BiddingArea
    {
        return $this->biddingAreaRepository->create($request);
    }

    public function show($id): BiddingArea
    {
        return $this->biddingAreaRepository->find($id);
    }

    public function update(array $request, $id): BiddingArea
    {
        return $this->biddingAreaRepository->update($id, $request);
    }

    public function delete($id): BiddingArea
    {
        return $this->biddingAreaRepository->delete($id);
    }

    public function restore($id): BiddingArea
    {
        return $this->biddingAreaRepository->restore($id);
    }

    public function forceDelete($id): BiddingArea
    {
        return $this->biddingAreaRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->biddingAreaRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
