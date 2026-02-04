<?php

namespace App\Services;

use App\Models\Faq;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class FaqService
{
    private RepositoryInterface $FaqRepository;

    /**
     * FaqService constructor.
     * @param RepositoryInterface $FaqRepository
     */
    public function __construct(RepositoryInterface $FaqRepository)
    {
        $this->FaqRepository = $FaqRepository;
    }

    public function get()
    {
        return $this->FaqRepository->get();
    }

    public function create(array $request): Faq
    {
        return $this->FaqRepository->create($request);
    }

    public function show($id): Faq
    {
        return $this->FaqRepository->find($id);
    }

    public function update(array $request, $id): Faq
    {
        return $this->FaqRepository->update($id, $request);
    }

    public function delete($id): Faq
    {
        return $this->FaqRepository->delete($id);
    }

    public function restore($id): Faq
    {
        return $this->FaqRepository->restore($id);
    }

    public function forceDelete($id): Faq
    {
        return $this->FaqRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->FaqRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
