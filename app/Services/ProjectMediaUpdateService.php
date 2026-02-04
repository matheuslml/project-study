<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectMediaUpdateService
{
    public function __construct(
        protected ProjectMediaService $projectMediaService,
    ) {
        //
    }
    
    public function update(array $request, $projectMedia_id)
    {
        try {
            DB::beginTransaction();
            
            $this->projectMediaService->update($request, $projectMedia_id);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
