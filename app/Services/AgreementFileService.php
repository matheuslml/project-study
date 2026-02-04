<?php

namespace App\Services;

use App\Models\AgreementFile;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class AgreementFileService
{
    private RepositoryInterface $agreementFileRepository;

    /**
     * AgreementFileService constructor.
     * @param RepositoryInterface $agreementFileRepository
     */
    public function __construct(RepositoryInterface $agreementFileRepository)
    {
        $this->agreementFileRepository = $agreementFileRepository;
    }

    public function get()
    {
        return $this->agreementFileRepository->get();
    }

    public function create(array $request): AgreementFile
    {
        return $this->agreementFileRepository->create($request);
    }

    public function show($id): AgreementFile
    {
        return $this->agreementFileRepository->find($id);
    }

    public function update(array $request, $id): AgreementFile
    {
        return $this->agreementFileRepository->update($id, $request);
    }

    public function delete($id): AgreementFile
    {
        return $this->agreementFileRepository->delete($id);
    }

    public function restore($id): AgreementFile
    {
        return $this->agreementFileRepository->restore($id);
    }

    public function forceDelete($id): AgreementFile
    {
        return $this->agreementFileRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->agreementFileRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
