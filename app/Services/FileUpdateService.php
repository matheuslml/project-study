<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FileUpdateService
{
    public function __construct(
        protected UserService $userService,
        protected BiddingService $biddingService,
        protected FileService $FileService,
    ) {
        //
    }
    
    public function update(array $request)
    {
        try {
            DB::beginTransaction();
            
            $this->FileService->update($request, $request['file_id']);

            DB::commit();
        } catch (Exception $exception) {
            dd($exception);
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
