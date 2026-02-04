<?php

namespace App\Services;

use App\Models\GalleryType;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class GalleryTypeService
{
    private RepositoryInterface $galleryTypeRepository;

    /**
     * GalleryTypeService constructor.
     * @param RepositoryInterface $galleryTypeRepository
     */
    public function __construct(RepositoryInterface $galleryTypeRepository)
    {
        $this->galleryTypeRepository = $galleryTypeRepository;
    }

    public function get()
    {
        return $this->galleryTypeRepository->get();
    }

    public function create(array $request): GalleryType
    {
        return $this->galleryTypeRepository->create($request);
    }

    public function show($id): GalleryType
    {
        return $this->galleryTypeRepository->find($id);
    }

    public function update(array $request, $id): GalleryType
    {
        return $this->galleryTypeRepository->update($id, $request);
    }

    public function delete($id): GalleryType
    {
        return $this->galleryTypeRepository->delete($id);
    }

    public function restore($id): GalleryType
    {
        return $this->galleryTypeRepository->restore($id);
    }

    public function forceDelete($id): GalleryType
    {
        return $this->galleryTypeRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->galleryTypeRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
