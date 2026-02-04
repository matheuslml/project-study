<?php

namespace App\Services;

use App\Models\ProjectMedia;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class ProjectMediaService
{
    private RepositoryInterface $projectMediaRepository;

    /**
     * ProjectMediaService constructor.
     * @param RepositoryInterface $projectMediaRepository
     */
    public function __construct(RepositoryInterface $projectMediaRepository)
    {
        $this->projectMediaRepository = $projectMediaRepository;
    }

    public function get()
    {
        return $this->projectMediaRepository->get();
    }

    public function create(array $request): ProjectMedia
    {
        return $this->projectMediaRepository->create($request);
    }

    public function show($id): ProjectMedia
    {
        return $this->projectMediaRepository->find($id);
    }

    public function update(array $request, $id): ProjectMedia
    {
        return $this->projectMediaRepository->update($id, $request);
    }

    public function delete($id): ProjectMedia
    {
        return $this->projectMediaRepository->delete($id);
    }

    public function restore($id): ProjectMedia
    {
        return $this->projectMediaRepository->restore($id);
    }

    public function forceDelete($id): ProjectMedia
    {
        return $this->projectMediaRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->projectMediaRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
