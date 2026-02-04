<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DirectHireWinnerUpdateService
{
    public function __construct(
        protected UserService $userService,
        protected DirectHireService $DirectHireService,
        protected DirectHireWinnerService $DirectHireWinnerService,
    ) {
        //
    }
    
    public function update(array $request)
    {
        try {
            DB::beginTransaction();
            
            $this->DirectHireWinnerService->update($request, $request['direct_hire_winner_id']);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
