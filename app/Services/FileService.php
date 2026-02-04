<?php

namespace App\Services;

use App\Models\File;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class FileService
{
    private RepositoryInterface $FileRepository;

    /**
     * FileService constructor.
     * @param RepositoryInterface $FileRepository
     */
    public function __construct(RepositoryInterface $FileRepository)
    {
        $this->FileRepository = $FileRepository;
    }

    public function get()
    {
        return $this->FileRepository->get();
    }

    public function create(array $request): File
    {
        return $this->FileRepository->create($request);
    }

    public function show($id): File
    {
        return $this->FileRepository->find($id);
    }

    public function update(array $request, $id): File
    {
        return $this->FileRepository->update($id, $request);
    }

    public function delete($id): File
    {
        return $this->FileRepository->delete($id);
    }

    public function restore($id): File
    {
        return $this->FileRepository->restore($id);
    }

    public function forceDelete($id): File
    {
        return $this->FileRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->FileRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
