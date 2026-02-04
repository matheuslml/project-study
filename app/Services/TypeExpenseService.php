<?php

namespace App\Services;

use App\Models\TypeExpense;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class TypeExpenseService
{
    private RepositoryInterface $typeExpenseRepository;

    /**
     * TypeExpenseService constructor.
     * @param RepositoryInterface $typeExpenseRepository
     */
    public function __construct(RepositoryInterface $typeExpenseRepository)
    {
        $this->typeExpenseRepository = $typeExpenseRepository;
    }

    public function get()
    {
        return $this->typeExpenseRepository->get();
    }

    public function create(array $request): TypeExpense
    {
        return $this->typeExpenseRepository->create($request);
    }

    public function show($id): TypeExpense
    {
        return $this->typeExpenseRepository->find($id);
    }

    public function update(array $request, $id): TypeExpense
    {
        return $this->typeExpenseRepository->update($id, $request);
    }

    public function delete($id): TypeExpense
    {
        return $this->typeExpenseRepository->delete($id);
    }

    public function restore($id): TypeExpense
    {
        return $this->typeExpenseRepository->restore($id);
    }

    public function forceDelete($id): TypeExpense
    {
        return $this->typeExpenseRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->typeExpenseRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
