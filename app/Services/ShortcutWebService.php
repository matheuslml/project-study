<?php

namespace App\Services;

use App\Models\ShortcutWeb;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class ShortcutWebService
{
    private RepositoryInterface $shortcutWebRepository;

    /**
     * ShortcutWebService constructor.
     * @param RepositoryInterface $shortcutWebRepository
     */
    public function __construct(RepositoryInterface $shortcutWebRepository)
    {
        $this->shortcutWebRepository = $shortcutWebRepository;
    }

    public function get()
    {
        return $this->shortcutWebRepository->get();
    }

    public function create(array $request): ShortcutWeb
    {
        return $this->shortcutWebRepository->create($request);
    }

    public function show($id): ShortcutWeb
    {
        return $this->shortcutWebRepository->find($id);
    }

    public function update(array $request, $id): ShortcutWeb
    {
        return $this->shortcutWebRepository->update($id, $request);
    }

    public function delete($id): ShortcutWeb
    {
        return $this->shortcutWebRepository->delete($id);
    }

    public function restore($id): ShortcutWeb
    {
        return $this->shortcutWebRepository->restore($id);
    }

    public function forceDelete($id): ShortcutWeb
    {
        return $this->shortcutWebRepository->forceDelete($id);
    }

    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null): Paginator
    {
        return $this->shortcutWebRepository->paginate($perPage, $columns, $pageName, $page);
    }
}
