<?php

namespace App\Services;

use App\Models\BlankPage;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class BlankPageService
{
    private RepositoryInterface $blankPageRepository;

    /**
     * BlankPageService constructor.
     * @param RepositoryInterface $blankPageRepository
     */
    public function __construct(RepositoryInterface $blankPageRepository)
    {
        $this->blankPageRepository = $blankPageRepository;
    }

    public function get()
    {
        return $this->blankPageRepository->get();
    }

    public function create(array $request): BlankPage
    {
        return $this->blankPageRepository->create($request);
    }

    public function show($id): BlankPage
    {
        return $this->blankPageRepository->find($id);
    }

    public function update(array $request, $id): BlankPage
    {
        return $this->blankPageRepository->update($id, $request);
    }

    public function delete($id): BlankPage
    {
        return $this->blankPageRepository->delete($id);
    }

    public function restore($id): BlankPage
    {
        return $this->blankPageRepository->restore($id);
    }

    public function forceDelete($id): BlankPage
    {
        return $this->blankPageRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->blankPageRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
