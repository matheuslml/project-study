<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;

class BiddingAgreementCreateService
{
    public function __construct(
        protected BiddingAgreementService $biddingAgreementService,
    ) {
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
            $this->biddingAgreementService->create($changed);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            dd($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
