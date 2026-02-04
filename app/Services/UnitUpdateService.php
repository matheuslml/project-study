<?php

namespace App\Services;

use App\Models\Unit;
use App\Models\Copyright;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UnitUpdateService
{
    // @codingStandardsIgnoreStart
    // TODO: CSFix
    public function __construct(
        protected UnitService $unitService,
    ) {
        //
    }

    public function update(array $request, $unit_id)
    {
        try {
            DB::beginTransaction();

            $unit_old = Unit::find($unit_id);

            $this->unitService->update($request, $unit_id);

            if(isset($request['logo'])){
                Storage::disk('units')->delete($unit_old->logo);
            }
            if(isset($request['icon'])){
                Storage::disk('units')->delete($unit_old->icon);
            }

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            dd($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
