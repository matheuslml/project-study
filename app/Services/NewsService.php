<?php

namespace App\Services;

use App\Models\News;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class NewsService
{
    private RepositoryInterface $newsRepository;

    /**
     * NewsService constructor.
     * @param RepositoryInterface $newsRepository
     */
    public function __construct(RepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function get()
    {
        return $this->newsRepository->get();
    }

    public function create(array $request): News
    {
        return $this->newsRepository->create($request);
    }

    public function show($id): News
    {
        return $this->newsRepository->find($id);
    }

    public function update(array $request, $id): News
    {
        return $this->newsRepository->update($id, $request);
    }

    public function delete($id): News
    {
        return $this->newsRepository->delete($id);
    }

    public function restore($id): News
    {
        return $this->newsRepository->restore($id);
    }

    public function forceDelete($id): News
    {
        return $this->newsRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->newsRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
