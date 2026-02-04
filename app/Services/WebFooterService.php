<?php

namespace App\Services;

use App\Models\WebFooter;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class WebFooterService
{
    private RepositoryInterface $webFooterRepository;

    /**
     * WebFooterService constructor.
     * @param RepositoryInterface $webFooterRepository
     */
    public function __construct(RepositoryInterface $webFooterRepository)
    {
        $this->webFooterRepository = $webFooterRepository;
    }

    public function get()
    {
        return $this->webFooterRepository->get();
    }

    public function create(array $request): WebFooter
    {
        return $this->webFooterRepository->create($request);
    }

    public function show($id): WebFooter
    {
        return $this->webFooterRepository->find($id);
    }

    public function update(array $request, $id): WebFooter
    {
        return $this->webFooterRepository->update($id, $request);
    }

    public function delete($id): WebFooter
    {
        return $this->webFooterRepository->delete($id);
    }

    public function restore($id): WebFooter
    {
        return $this->webFooterRepository->restore($id);
    }

    public function forceDelete($id): WebFooter
    {
        return $this->webFooterRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->webFooterRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
