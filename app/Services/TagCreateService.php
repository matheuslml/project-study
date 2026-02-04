<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagCreateService
{
    public function __construct(
        protected TagService $TagService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();
            $this->TagService->create($request);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
