<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DirectHireItemUpdateService
{
    public function __construct(
        protected DirectHireItemService $DirectHireItemService,
    ) {
        //
    }
    
    public function update(array $request, $item_id)
    {
        try {
            DB::beginTransaction();
            
            $this->DirectHireItemService->update($request, $item_id);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
