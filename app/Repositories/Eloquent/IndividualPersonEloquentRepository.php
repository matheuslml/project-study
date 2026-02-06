<?php

namespace App\Repositories\Eloquent;

use App\Models\IndividualPerson;
use App\Repositories\EloquentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;

class IndividualPersonEloquentRepository extends EloquentRepository
{
    #[Pure]
    public function __construct()
    {
        parent::__construct(new IndividualPerson());
    }

    public function update($id, array $data): IndividualPerson | Model
    {
        return parent::update($id, $data);
    }

    public function create($data): IndividualPerson | Model
    {
        return parent::create($data);
    }

    public function get(): Collection
    {
        return parent::get();
    }

    public function find($id): IndividualPerson | Model
    {
        return parent::find($id);
    }

    public function withTrashed(): Builder
    {
        return parent::withTrashed();
    }

    public function delete($id): IndividualPerson | Model
    {
        return parent::delete($id);
    }

    public function restore($id): IndividualPerson | Model
    {
        return parent::restore($id);
    }

    public function forceDelete($id): IndividualPerson | Model
    {
        return parent::forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return parent::paginate($perPage, $columns, $pageName, $page);
    }
}
