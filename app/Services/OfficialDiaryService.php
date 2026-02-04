<?php

namespace App\Services;

use App\Models\OfficialDiary;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class OfficialDiaryService
{
    private RepositoryInterface $OfficialDiaryRepository;

    /**
     * OfficialDiaryService constructor.
     * @param RepositoryInterface $OfficialDiaryRepository
     */
    public function __construct(RepositoryInterface $OfficialDiaryRepository)
    {
        $this->OfficialDiaryRepository = $OfficialDiaryRepository;
    }

    public function get()
    {
        return $this->OfficialDiaryRepository->get();
    }

    public function create(array $request): OfficialDiary
    {
        return $this->OfficialDiaryRepository->create($request);
    }

    public function show($id): OfficialDiary
    {
        return $this->OfficialDiaryRepository->find($id);
    }

    public function update(array $request, $id): OfficialDiary
    {
        return $this->OfficialDiaryRepository->update($id, $request);
    }

    public function delete($id): OfficialDiary
    {
        return $this->OfficialDiaryRepository->delete($id);
    }

    public function restore($id): OfficialDiary
    {
        return $this->OfficialDiaryRepository->restore($id);
    }

    public function forceDelete($id): OfficialDiary
    {
        return $this->OfficialDiaryRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->OfficialDiaryRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
