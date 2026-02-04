<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RevenueCreateService
{
    public function __construct(
        protected RevenueService $revenueService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();
            $strings_1 = ['.', 'R$ ', ','];
            $strings_2 = ['', '', '.'];
            $replacements = array(
                "value" => floatval(str_replace($strings_1, $strings_2, $request['value'])),
            );
    
            $changed = array_replace($request, $replacements);
            $revenue = $this->revenueService->create($changed);
            
            
            DB::commit();
            return $revenue;
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
