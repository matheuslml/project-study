<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TypeExpenseUpdateService
{
    // @codingStandardsIgnoreStart
    // TODO: CSFix
    public function __construct(
        protected TypeExpenseService $typeExpenseService,
    ) {
        //
    }
    
    public function update(array $request, $type_id)
    {
        try {
            DB::beginTransaction();
            
            $this->typeExpenseService->update($request, $type_id);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
