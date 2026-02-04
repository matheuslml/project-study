<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DirectHireItemCreateService
{
    public function __construct(
        protected DirectHireItemService $DirectHireItemService,
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
            $this->DirectHireItemService->create($changed);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
