<?php

namespace App\Services;

use App\Models\Copyright;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CopyrightUpdateService
{
    public function __construct(
        protected CopyrightService $copyrightService,
    ) {
        //
    }

    public function update(array $request, $copyright_id)
    {
        try {
            DB::beginTransaction();

            $this->copyrightService->update($request, $copyright_id);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
