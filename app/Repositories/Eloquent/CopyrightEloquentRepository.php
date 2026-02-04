<?php

namespace App\Repositories\Eloquent;

use App\Models\Copyright;
use App\Repositories\EloquentRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CopyrightEloquentRepository extends EloquentRepository
{
    public function __construct()
    {
        parent::__construct(new Copyright());
    }

    public function get(): Collection
    {
        return parent::get();
    }

    public function create($data): Copyright | Model
    {
        return parent::create($data);
    }

    public function find($id): Copyright | Model
    {
        return parent::find($id);
    }

    public function withTrashed(): Builder
    {
        return parent::withTrashed();
    }

    public function update($id, $data): Copyright | Model
    {
        return parent::update($id, $data);
    }

    public function delete($id): Copyright | Model
    {
        return parent::delete($id);
    }

    public function restore($id): Copyright | Model
    {
        return parent::restore($id);
    }

    public function forceDelete($id): Copyright | Model
    {
        return parent::forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return parent::paginate($perPage, $columns, $pageName, $page);
    }
}
