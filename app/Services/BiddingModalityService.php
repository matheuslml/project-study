<?php

namespace App\Services;

use App\Models\BiddingModality;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class BiddingModalityService
{
    private RepositoryInterface $biddingModalityRepository;

    /**
     * BiddingModalityService constructor.
     * @param RepositoryInterface $biddingModalityRepository
     */
    public function __construct(RepositoryInterface $biddingModalityRepository)
    {
        $this->biddingModalityRepository = $biddingModalityRepository;
    }

    public function get()
    {
        return $this->biddingModalityRepository->get();
    }

    public function create(array $request): BiddingModality
    {
        return $this->biddingModalityRepository->create($request);
    }

    public function show($id): BiddingModality
    {
        return $this->biddingModalityRepository->find($id);
    }

    public function update(array $request, $id): BiddingModality
    {
        return $this->biddingModalityRepository->update($id, $request);
    }

    public function delete($id): BiddingModality
    {
        return $this->biddingModalityRepository->delete($id);
    }

    public function restore($id): BiddingModality
    {
        return $this->biddingModalityRepository->restore($id);
    }

    public function forceDelete($id): BiddingModality
    {
        return $this->biddingModalityRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->biddingModalityRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
