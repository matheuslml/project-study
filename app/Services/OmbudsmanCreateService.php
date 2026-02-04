<?php

namespace App\Services;

use App\Models\Ombudsman;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OmbudsmanCreateService
{
    // @codingStandardsIgnoreStart
    // TODO: CSFix
    public function __construct(
        protected OmbudsmanService $OmbudsmanService,
    ) {
        //
    }
    // @codingStandardsIgnoreEndqqq

    public function create(array $request)
    {
        try {
            DB::beginTransaction();
                Ombudsman::create(
                    [
                        'type_request_id' => $request['type_request_id'],
                        'access_id' => $request['access_id'],
                        'name' => $request['name'],
                        'title' => $request['title'],
                        'email' => $request['email'],
                        'protocol' => rand(10000000, 99999999),
                        'answer' => '',
                        'content' => $request['content'],
                    ]
                );
            DB::commit();
        } catch (Exception $exception) {
            ////Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
