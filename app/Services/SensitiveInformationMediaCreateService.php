<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SensitiveInformationMediaCreateService
{
    public function __construct(
        protected SensitiveInformationMediaService $projectMediaService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();
            $this->projectMediaService->create($request);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
