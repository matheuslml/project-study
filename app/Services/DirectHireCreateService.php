<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;

class DirectHireCreateService
{
    public function __construct(
        protected DirectHireService $directHireService,
    ) {
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();
            $strings_1 = ['.', 'R$ ', ','];
            $strings_2 = ['', '', '.'];
            $replacements = array(
                "value_min" => floatval(str_replace($strings_1, $strings_2, $request['value_min'])),
                "value_max" => floatval(str_replace($strings_1, $strings_2, $request['value_max']))
            );
    
            $changed = array_replace($request, $replacements);
            $this->directHireService->create($changed);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            dd($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
