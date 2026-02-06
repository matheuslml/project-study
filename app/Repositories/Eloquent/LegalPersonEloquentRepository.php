<?php

namespace App\Repositories\Eloquent;

use App\Models\LegalPerson;
use App\Repositories\EloquentRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;
use Spatie\QueryBuilder\QueryBuilder;

class LegalPersonEloquentRepository extends EloquentRepository
{
    #[Pure]
    public function __construct()
    {
        parent::__construct(new LegalPerson());
    }

    public function create($data): LegalPerson | Model
    {
        return parent::create($data);
    }

    public function update($id, $data): LegalPerson | Model
    {
        return parent::update($id, $data);
    }

    public function get(): Collection | array
    {
        return parent::get();
    }

    public function find($id): LegalPerson | Model
    {
        return parent::find($id);
    }

    public function withTrashed(): Builder
    {
        return parent::withTrashed();
    }

    public function delete($id): LegalPerson | Model
    {
        return parent::delete($id);
    }

    public function restore($id): LegalPerson | Model
    {
        return parent::restore($id);
    }

    public function forceDelete($id): LegalPerson | Model
    {
        return parent::forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return parent::paginate($perPage, $columns, $pageName, $page);
    }
}
