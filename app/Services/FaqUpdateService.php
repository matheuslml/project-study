<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FaqUpdateService
{
    public function __construct(
        protected FaqService $FaqService,
    ) {
        //
    }
    
    public function update(array $request, $faq_id)
    {
        try {
            DB::beginTransaction();
            
            $this->FaqService->update($request, $faq_id);

            DB::commit();
        } catch (Exception $exception) {
            dd($exception);
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
