<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BiddingItemCreateService
{
    public function __construct(
        protected UserService $userService,
        protected BiddingService $biddingService,
        protected BiddingItemService $biddingItemService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();
            $strings = array(".", "R$ ");
            $replacements = array(
                "value" => floatval(str_replace($strings, '', $request['value']))
            );
    
            $changed = array_replace($request, $replacements);
            $this->biddingItemService->create($changed);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
