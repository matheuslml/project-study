<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ExpenseCreateService
{
    public function __construct(
        protected ExpenseService $ExpenseService,
    ) {
        //
    }

    public function create(array $request)
    {

        try {
            DB::beginTransaction();
            $strings_1 = ['.', 'R$ ', ','];
            $strings_2 = ['', '', '.'];
            $replacements = array(
                "current_balance" => floatval(str_replace($strings_1, $strings_2, $request['current_balance'])),
                "blocked_balance" => floatval(str_replace($strings_1, $strings_2, $request['blocked_balance'])),
                "used_balance" => floatval(str_replace($strings_1, $strings_2, $request['used_balance'])),
                "available_balance" => floatval(str_replace($strings_1, $strings_2, $request['available_balance'])),
                "user_id" => Auth::user()->id
            );
    
            $changed = array_replace($request, $replacements);
            $this->ExpenseService->create($changed);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            dd($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
