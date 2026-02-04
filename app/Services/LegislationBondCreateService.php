<?php

namespace App\Services;

use App\Models\LegislationBond;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LegislationBondCreateService
{
    public function __construct(
        protected LegislationBondService $legislationBondService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            //dd($request);
            DB::beginTransaction();
            $this->legislationBondService->create($request);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
