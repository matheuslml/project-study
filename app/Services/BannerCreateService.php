<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;

class BannerCreateService
{
    public function __construct(
        protected BannerService $bannerService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();
            $strings = array(".", "R$ ");
            $replacements = array(
                "value_max" => floatval(str_replace($strings, '', $request['value_max']))
            );
    
            $changed = array_replace($request, $replacements);
            $this->bannerService->create($changed);

            DB::commit();
        } catch (Exception $exception) {
            ////Bugsnag::notifyException($exception);
            DB::rollBack();
            dd($exception);
            throw new Exception($exception);
        }
    }
}
