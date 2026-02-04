<?php

namespace App\Repositories\Eloquent;

use App\Models\ActTopic;
use App\Repositories\EloquentRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;

class ActTopicEloquentRepository extends EloquentRepository
{
    //#[Pure]
    public function __construct()
    {
        parent::__construct(new ActTopic());
    }

    public function get(): Collection
    {
        return parent::get();
    }

    public function create(array $data): ActTopic | Model
    {
        return parent::create($data);
    }

    public function find($id): ActTopic | Model
    {
        return parent::find($id);
    }

    public function withTrashed(): Builder
    {
        return parent::withTrashed();
    }

    public function update($id, array $data): ActTopic | Model
    {
        return parent::update($id, $data);
    }

    public function delete($id): ActTopic | Model
    {
        return parent::delete($id);
    }

    public function restore($id): ActTopic | Model
    {
        return parent::restore($id);
    }

    public function forceDelete($id): ActTopic | Model
    {
        return parent::forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return parent::paginate($perPage, $columns, $pageName, $page);
    }
}
