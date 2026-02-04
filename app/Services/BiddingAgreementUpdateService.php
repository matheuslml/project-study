<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BiddingAgreementUpdateService
{
    public function __construct(
        protected UserService $userService,
        protected BiddingService $biddingService,
        protected BiddingAgreementService $biddingAgreementService,
    ) {
        //
    }
    
    public function update(array $request, $agreement_id)
    {
        try {
            DB::beginTransaction();
            $strings_1 = ['.', 'R$ ', ','];
            $strings_2 = ['', '', '.'];
            $replacements = array(
                "value" => floatval(str_replace($strings_1, $strings_2, $request['value'])),
            );
    
            $changed = array_replace($request, $replacements);
            
            $this->biddingAgreementService->update($changed, $agreement_id);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            dd($exception);
            throw new Exception($exception);
        }
    }
}
