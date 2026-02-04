<?php

namespace App\Services;

use App\Models\SensitiveInformationMedia;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class SensitiveInformationMediaService
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

    public function create(array $request): SensitiveInformationMedia
    {
        return $this->projectMediaRepository->create($request);
    }

    public function show($id): SensitiveInformationMedia
    {
        return $this->projectMediaRepository->find($id);
    }

    public function update(array $request, $id): SensitiveInformationMedia
    {
        return $this->projectMediaRepository->update($id, $request);
    }

    public function delete($id): SensitiveInformationMedia
    {
        return $this->projectMediaRepository->delete($id);
    }

    public function restore($id): SensitiveInformationMedia
    {
        return $this->projectMediaRepository->restore($id);
    }

    public function forceDelete($id): SensitiveInformationMedia
    {
        return $this->projectMediaRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->projectMediaRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
