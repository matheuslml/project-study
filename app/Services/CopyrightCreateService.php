<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;

class CopyrightCreateService
{
    public function __construct(
        protected CopyrightService $copyrightService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();

            $this->copyrightService->create($request);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            dd($exception);
            throw new Exception($exception);
        }
    }
}
