<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BiddingUpdateService
{
    public function __construct(
        protected UserService $userService,
        protected BiddingService $biddingService,
    ) {
        //
    }
    
    public function update(array $request, $bidding_id)
    {
        try {
            DB::beginTransaction();
            $strings_1 = ['.', 'R$ ', ','];
            $strings_2 = ['', '', '.'];
            $replacements = array(
                "value_max" => floatval(str_replace($strings_1, $strings_2, $request['value_max'])),
            );
    
            $changed = array_replace($request, $replacements);
            $this->biddingService->update($changed, $bidding_id);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
