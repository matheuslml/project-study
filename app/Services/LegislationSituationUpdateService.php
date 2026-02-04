<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LegislationSituationUpdateService
{
    public function __construct(
        protected LegislationSituationService $legislationSituationService,
    ) {
        //
    }
    
    public function update(array $request, $situation_id)
    {
        try {
            DB::beginTransaction();
            
            $this->legislationSituationService->update($request, $situation_id);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
