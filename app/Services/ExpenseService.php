<?php

namespace App\Services;

use App\Models\Expense;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class ExpenseService
{
    private RepositoryInterface $ExpenseRepository;

    /**
     * ExpenseService constructor.
     * @param RepositoryInterface $ExpenseRepository
     */
    public function __construct(RepositoryInterface $ExpenseRepository)
    {
        $this->ExpenseRepository = $ExpenseRepository;
    }

    public function get()
    {
        return $this->ExpenseRepository->get();
    }

    public function create(array $request): Expense
    {
        return $this->ExpenseRepository->create($request);
    }

    public function show($id): Expense
    {
        return $this->ExpenseRepository->find($id);
    }

    public function update(array $request, $id): Expense
    {
        return $this->ExpenseRepository->update($id, $request);
    }

    public function delete($id): Expense
    {
        return $this->ExpenseRepository->delete($id);
    }

    public function restore($id): Expense
    {
        return $this->ExpenseRepository->restore($id);
    }

    public function forceDelete($id): Expense
    {
        return $this->ExpenseRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->ExpenseRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
