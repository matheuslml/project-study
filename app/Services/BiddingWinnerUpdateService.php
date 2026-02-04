<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BiddingWinnerUpdateService
{
    public function __construct(
        protected UserService $userService,
        protected BiddingService $biddingService,
        protected BiddingWinnerService $biddingWinnerService,
    ) {
        //
    }
    
    public function update(array $request)
    {
        try {
            DB::beginTransaction();
            
            $this->biddingWinnerService->update($request, $request['bidding_winner_id']);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
