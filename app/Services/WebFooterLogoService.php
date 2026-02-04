<?php

namespace App\Services;

use App\Models\WebFooterLogo;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class WebFooterLogoService
{
    private RepositoryInterface $webFooterLogoRepository;

    /**
     * WebFooterLogoService constructor.
     * @param RepositoryInterface $webFooterLogoRepository
     */
    public function __construct(RepositoryInterface $webFooterLogoRepository)
    {
        $this->webFooterLogoRepository = $webFooterLogoRepository;
    }

    public function get()
    {
        return $this->webFooterLogoRepository->get();
    }

    public function create(array $request): WebFooterLogo
    {
        return $this->webFooterLogoRepository->create($request);
    }

    public function show($id): WebFooterLogo
    {
        return $this->webFooterLogoRepository->find($id);
    }

    public function update(array $request, $id): WebFooterLogo
    {
        return $this->webFooterLogoRepository->update($id, $request);
    }

    public function delete($id): WebFooterLogo
    {
        return $this->webFooterLogoRepository->delete($id);
    }

    public function restore($id): WebFooterLogo
    {
        return $this->webFooterLogoRepository->restore($id);
    }

    public function forceDelete($id): WebFooterLogo
    {
        return $this->webFooterLogoRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->webFooterLogoRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
