<?php

namespace App\Services;

use App\Models\Project;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectCreateService
{
    public function __construct(
        protected ProjectService $projectService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();

            $project = Project::create([
                'category_id' => $request['category_id'],
                'project_responsible_id' => $request['responsible_id'],
                'title' => $request['title'],
                'sub_title' => $request['sub_title'],
                'amount' => $request['amount'],
                'term' => $request['term'],
                'description' =>$request['description'],
                'excerpt' => $request['content'],
                'body' => $request['content'],
                'thumb' => isset($request['path']) ? $request['path']  : '',
                'meta_description' => $request['content'],
                'status' => $request['status']
            ]);

            DB::commit();
        } catch (Exception $exception) {
            dd($exception);
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
