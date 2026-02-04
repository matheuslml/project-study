<?php

namespace App\Services;

use App\Models\SensitiveInformation;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\ProjectTag;
use Illuminate\Support\Facades\Storage;

class SensitiveInformationUpdateService
{
    public function __construct(
        protected SensitiveInformationService $projectService,

    ) {
        //
    }

    public function update(array $request, $project_id)
    {
        try {
            DB::beginTransaction();

            $project = SensitiveInformation::find($project_id);
            $old_path = $project->thumb;

            $project->title = $request['title'];
            $project->description = $request['description'];
            $project->category_id = $request['category_id'];
            $project->responsible_id = $request['responsible_id'];
            $project->archive = isset($request['path']) ? $request['path']  : $old_path;
            $project->excerpt = $request['content'];
            $project->body = $request['content'];

            $project->save();
            

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
