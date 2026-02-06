<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TypeRequestUpdateService
{
    // @codingStandardsIgnoreStart
    // TODO: CSFix
    public function __construct(
        protected UserService $userService,
        protected PersonService $personService,
        protected TypeRequestService $TypeRequestService,
    ) {
        //
    }
    
    public function update(array $request, $request_id)
    {
        try {
            DB::beginTransaction();
            
            $this->TypeRequestService->update($request, $request_id);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
