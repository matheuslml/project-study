<?php

namespace App\Services;

use App\Models\BiddingAgreement;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class BiddingAgreementService
{
    private RepositoryInterface $biddingAgreementRepository;

    /**
     * BiddingAgreementService constructor.
     * @param RepositoryInterface $biddingAgreementRepository
     */
    public function __construct(RepositoryInterface $biddingAgreementRepository)
    {
        $this->biddingAgreementRepository = $biddingAgreementRepository;
    }

    public function get()
    {
        return $this->biddingAgreementRepository->get();
    }

    public function create(array $request): BiddingAgreement
    {
        return $this->biddingAgreementRepository->create($request);
    }

    public function show($id): BiddingAgreement
    {
        return $this->biddingAgreementRepository->find($id);
    }

    public function update(array $request, $id): BiddingAgreement
    {
        return $this->biddingAgreementRepository->update($id, $request);
    }

    public function delete($id): BiddingAgreement
    {
        return $this->biddingAgreementRepository->delete($id);
    }

    public function restore($id): BiddingAgreement
    {
        return $this->biddingAgreementRepository->restore($id);
    }

    public function forceDelete($id): BiddingAgreement
    {
        return $this->biddingAgreementRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->biddingAgreementRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
