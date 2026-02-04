<?php

namespace App\Services;

use App\Models\BiddingItem;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class BiddingItemService
{
    private RepositoryInterface $biddingItemRepository;

    /**
     * BiddingItemService constructor.
     * @param RepositoryInterface $biddingItemRepository
     */
    public function __construct(RepositoryInterface $biddingItemRepository)
    {
        $this->biddingItemRepository = $biddingItemRepository;
    }

    public function get()
    {
        return $this->biddingItemRepository->get();
    }

    public function create(array $request): BiddingItem
    {
        return $this->biddingItemRepository->create($request);
    }

    public function show($id): BiddingItem
    {
        return $this->biddingItemRepository->find($id);
    }

    public function update(array $request, $id): BiddingItem
    {
        return $this->biddingItemRepository->update($id, $request);
    }

    public function delete($id): BiddingItem
    {
        return $this->biddingItemRepository->delete($id);
    }

    public function restore($id): BiddingItem
    {
        return $this->biddingItemRepository->restore($id);
    }

    public function forceDelete($id): BiddingItem
    {
        return $this->biddingItemRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->biddingItemRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
