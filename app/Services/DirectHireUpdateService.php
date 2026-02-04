<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DirectHireUpdateService
{
    public function __construct(
        protected DirectHireService $directHireService,
    ) {
        //
    }
    
    public function update(array $request, $direct_hire_id)
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
            
            $this->directHireService->update($changed, $direct_hire_id);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            dd($exception);
            throw new Exception($exception);
        }
    }
}
