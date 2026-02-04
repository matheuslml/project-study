<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryUpdateService
{
    public function __construct(
        protected UserService $userService,
        protected BiddingService $biddingService,
        protected CategoryService $CategoryService,
    ) {
        //
    }
    
    public function update(array $request, $category_id)
    {
        try {
            DB::beginTransaction();
            
            $this->CategoryService->update($request, $category_id);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
