<?php

namespace App\Services;

use App\Models\ActTopic;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ActTopicUpdateService
{
    public function __construct(
        protected ActTopicService $actTopicService,
    ) {
        //
    }

    public function update(array $request, $actTopic_id)
    {

        try {
            DB::beginTransaction();
            if($request['act_topic_id'] == 'PRINCIPAL'){
                ActTopic::updateOrCreate(
                    ['id' => $actTopic_id],
                    [
                        'title' => $request['title'],
                        'act_topic_id' => null,
                        'status' => $request['status'],
                    ]
                );
            }else{
                ActTopic::updateOrCreate(
                    ['id' => $actTopic_id],
                    [
                        'title' => $request['title'],
                        'act_topic_id' => $request['act_topic_id'],
                        'status' => $request['status'],
                    ]
                );
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
