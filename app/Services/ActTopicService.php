<?php

namespace App\Services;

use App\Models\ActTopic;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class ActTopicService
{
    private RepositoryInterface $actTopicRepository;

    /**
     * ActTopicService constructor.
     * @param RepositoryInterface $actTopicRepository
     */
    public function __construct(RepositoryInterface $actTopicRepository)
    {
        $this->actTopicRepository = $actTopicRepository;
    }

    public function get()
    {
        return $this->actTopicRepository->get();
    }

    public function create(array $request): ActTopic
    {
        return $this->actTopicRepository->create($request);
    }

    public function show($id): ActTopic
    {
        return $this->actTopicRepository->find($id);
    }

    public function update(array $request, $id): ActTopic
    {
        return $this->actTopicRepository->update($id, $request);
    }

    public function delete($id): ActTopic
    {
        return $this->actTopicRepository->delete($id);
    }

    public function restore($id): ActTopic
    {
        return $this->actTopicRepository->restore($id);
    }

    public function forceDelete($id): ActTopic
    {
        return $this->actTopicRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->actTopicRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
