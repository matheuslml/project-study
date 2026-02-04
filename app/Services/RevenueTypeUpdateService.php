<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;

class RevenueTypeUpdateService
{
    public function __construct(
        protected RevenueTypeService $revenueTypeService,
    ) {
        //
    }
    
    public function update(array $request, $revenueType_id)
    {
        try {
            DB::beginTransaction();
            
            $this->revenueTypeService->update($request, $revenueType_id);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
