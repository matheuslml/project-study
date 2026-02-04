<?php

namespace App\Services;

use App\Models\Gallery;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class GalleryService
{
    private RepositoryInterface $galleryRepository;

    /**
     * GalleryService constructor.
     * @param RepositoryInterface $galleryRepository
     */
    public function __construct(RepositoryInterface $galleryRepository)
    {
        $this->galleryRepository = $galleryRepository;
    }

    public function get()
    {
        return $this->galleryRepository->get();
    }

    public function create(array $request): Gallery
    {
        return $this->galleryRepository->create($request);
    }

    public function show($id): Gallery
    {
        return $this->galleryRepository->find($id);
    }

    public function update(array $request, $id): Gallery
    {
        return $this->galleryRepository->update($id, $request);
    }

    public function delete($id): Gallery
    {
        return $this->galleryRepository->delete($id);
    }

    public function restore($id): Gallery
    {
        return $this->galleryRepository->restore($id);
    }

    public function forceDelete($id): Gallery
    {
        return $this->galleryRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->galleryRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
