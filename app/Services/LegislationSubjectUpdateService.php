<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LegislationSubjectUpdateService
{
    public function __construct(
        protected LegislationSubjectService $legislationSubjectService,
    ) {
        //
    }
    
    public function update(array $request, $subject_id)
    {
        try {
            DB::beginTransaction();
            
            $this->legislationSubjectService->update($request, $subject_id);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
