<?php

namespace App\Services;

use App\Models\AgreementType;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class AgreementTypeService
{
    private RepositoryInterface $agreementTypeRepository;

    /**
     * AgreementTypeService constructor.
     * @param RepositoryInterface $agreementTypeRepository
     */
    public function __construct(RepositoryInterface $agreementTypeRepository)
    {
        $this->agreementTypeRepository = $agreementTypeRepository;
    }

    public function get()
    {
        return $this->agreementTypeRepository->get();
    }

    public function create(array $request): AgreementType
    {
        return $this->agreementTypeRepository->create($request);
    }

    public function show($id): AgreementType
    {
        return $this->agreementTypeRepository->find($id);
    }

    public function update(array $request, $id): AgreementType
    {
        return $this->agreementTypeRepository->update($id, $request);
    }

    public function delete($id): AgreementType
    {
        return $this->agreementTypeRepository->delete($id);
    }

    public function restore($id): AgreementType
    {
        return $this->agreementTypeRepository->restore($id);
    }

    public function forceDelete($id): AgreementType
    {
        return $this->agreementTypeRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->agreementTypeRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
