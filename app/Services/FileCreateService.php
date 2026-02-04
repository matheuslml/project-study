<?php

namespace App\Services;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FileCreateService
{
    public function __construct(
        protected FileService $fileService,
    ) {
        //
    }

    public function create(array $request)
    {
        dd($request);
        /*try {
            DB::beginTransaction();
            $this->fileService->create($request);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            dd($exception);
            DB::rollBack();
            throw new Exception($exception);
        }*/
    }
}
