<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BiddingModalityUpdateService
{
    public function __construct(
        protected UserService $userService,
        protected BiddingService $biddingService,
        protected BiddingModalityService $biddingModalityService,
    ) {
        //
    }
    
    public function update(array $request, $modality_id)
    {
        try {
            DB::beginTransaction();
            
            $this->biddingModalityService->update($request, $modality_id);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
