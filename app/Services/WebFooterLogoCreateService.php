<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;

class WebFooterLogoCreateService
{
    public function __construct(
        protected WebFooterLogoService $webFooterLogoService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();

            $this->webFooterLogoService->create($request);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            dd($exception);
            throw new Exception($exception);
        }
    }
}
