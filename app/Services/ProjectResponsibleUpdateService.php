<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectResponsibleUpdateService
{
    public function __construct(
        protected ProjectResponsibleService $projectResponsibleService,
    ) {
        //
    }

    public function update(array $request, $project_responsible_id)
    {
        try {
            DB::beginTransaction();

            $this->projectResponsibleService->update($request, $project_responsible_id);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
