<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TypeAccessUpdateService
{
    // @codingStandardsIgnoreStart
    // TODO: CSFix
    public function __construct(
        protected UserService $userService,
        protected PersonService $personService,
        protected TypeAccessService $TypeAccessService,
    ) {
        //
    }
    
    public function update(array $request, $access_id)
    {
        try {
            DB::beginTransaction();
            
            $this->TypeAccessService->update($request, $access_id);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
