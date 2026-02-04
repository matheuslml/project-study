<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectCategoryUpdateService
{
    public function __construct(
        protected ProjectCategoryService $projectCategoryService,
    ) {
        //
    }
    
    public function update(array $request, $projectcategory_id)
    {
        try {
            DB::beginTransaction();
            
            $this->projectCategoryService->update($request, $projectcategory_id);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
