<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;

class BiddingCreateService
{
    public function __construct(
        protected BiddingService $biddingService,
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
                "value_max" => floatval(str_replace($strings_1, $strings_2, $request['value_max'])),
            );
    
            $changed = array_replace($request, $replacements);
            $this->biddingService->create($changed);

            DB::commit();
        } catch (Exception $exception) {
            ////Bugsnag::notifyException($exception);
            DB::rollBack();
            dd($exception);
            throw new Exception($exception);
        }
    }
}
