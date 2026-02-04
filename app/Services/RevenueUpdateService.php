<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;

class RevenueUpdateService
{
    public function __construct(
        protected RevenueService $revenueService,
    ) {
        //
    }
    
    public function update(array $request, $revenue_id)
    {
        try {
            DB::beginTransaction();
            $strings_1 = ['.', 'R$ ', ','];
            $strings_2 = ['', '', '.'];
            $replacements = array(
                "value" => floatval(str_replace($strings_1, $strings_2, $request['value'])),
            );
    
            $changed = array_replace($request, $replacements);
            
            $this->revenueService->update($changed, $revenue_id);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
