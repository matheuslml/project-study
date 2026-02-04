<?php

namespace App\Services;

use App\Models\Act;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ActCreateService
{
    public function __construct(
        protected ActService $actService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();

                Act::create([
                    'act_topic_id' => $request['act_topic_id'],
                    'act_type' => $request['act_type'],
                    'title' => $request['title'],
                    'excerpt' => $request['content'],
                    'body' => $request['content'],
                    'status' => $request['status'],
                    'published_at' => $request['published_at'],
                    'order' =>$request['order']
                ]);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
