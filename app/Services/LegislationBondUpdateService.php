<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LegislationBondUpdateService
{
    public function __construct(
        protected LegislationBondService $legislationBondService,
    ) {
        //
    }
    
    public function update(array $request, $bond_id)
    {
        try {
            DB::beginTransaction();
            
            $this->legislationBondService->update($request, $bond_id);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
