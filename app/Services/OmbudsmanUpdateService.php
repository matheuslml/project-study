<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OmbudsmanUpdateService
{
    // @codingStandardsIgnoreStart
    // TODO: CSFix
    public function __construct(
        protected UserService $userService,
        protected PersonService $personService,
        protected OmbudsmanService $OmbudsmanService,
    ) {
        //
    }
    
    public function update(array $request)
    {
        try {
            DB::beginTransaction();
            
            $this->OmbudsmanService->update($request, $request['Ombudsman_id']);

            DB::commit();
        } catch (Exception $exception) {
            ////Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
