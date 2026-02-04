<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AgreementTypeUpdateService
{
    public function __construct(
        protected UserService $userService,
        protected BiddingService $biddingService,
        protected AgreementTypeService $agreementTypeService,
    ) {
        //
    }
    
    public function update(array $request, $type_id)
    {
        try {
            DB::beginTransaction();
            
            $this->agreementTypeService->update($request, $type_id);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
