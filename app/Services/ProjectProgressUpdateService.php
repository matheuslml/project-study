<?php

namespace App\Services;

use App\Models\ProjectProgress;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\ProjectProgressTag;
use Illuminate\Support\Facades\Storage;

class ProjectProgressUpdateService
{
    public function __construct(
        protected ProjectProgressService $projectProgressService,
    ) {
        //
    }

    public function update(array $request, $projectProgress_id)
    {
        try {
            DB::beginTransaction();

            $projectProgress = ProjectProgress::find($projectProgress_id);

            $projectProgress->project_id = $request['project_id'];
            $projectProgress->percentage = $request['percentage'];
            $projectProgress->excerpt = $request['content'];
            $projectProgress->body = $request['content'];
            $projectProgress->meta_description = $request['content'];
            $projectProgress->status = $request['status'];
            $projectProgress->save();

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}

