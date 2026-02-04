<?php

namespace App\Services;

use App\Models\Banner;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class BannerService
{
    private RepositoryInterface $bannerRepository;

    /**
     * BannerService constructor.
     * @param RepositoryInterface $bannerRepository
     */
    public function __construct(RepositoryInterface $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function get()
    {
        return $this->bannerRepository->get();
    }

    public function create(array $request): Banner
    {
        return $this->bannerRepository->create($request);
    }

    public function show($id): Banner
    {
        return $this->bannerRepository->find($id);
    }

    public function update(array $request, $id): Banner
    {
        return $this->bannerRepository->update($id, $request);
    }

    public function delete($id): Banner
    {
        return $this->bannerRepository->delete($id);
    }

    public function restore($id): Banner
    {
        return $this->bannerRepository->restore($id);
    }

    public function forceDelete($id): Banner
    {
        return $this->bannerRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->bannerRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
