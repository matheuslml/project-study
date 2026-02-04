<?php

namespace App\Services;

use App\Models\ActTopic;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ActTopicCreateService
{
    public function __construct(
        protected ActTopicService $actTopicService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();
            if($request['act_topic_id'] == 'PRINCIPAL'){
                ActTopic::create([
                    'title' => $request['title'],
                    'act_topic_id' => null,
                    'status' => $request['status'],
                ]);
            }else{
                ActTopic::create([
                    'title' => $request['title'],
                    'act_topic_id' => $request['act_topic_id'],
                    'status' => $request['status'],
                ]);
            }

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
