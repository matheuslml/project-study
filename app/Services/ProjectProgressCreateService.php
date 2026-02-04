<?php

namespace App\Services;

use App\Models\ProjectProgress;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectProgressCreateService
{
    public function __construct(
        protected ProjectProgressService $projectProgressService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();

            $strings_1 = ['%'];
            $strings_2 = [''];
            $replacements = array(
                "percentage" => str_replace($strings_1, $strings_2, $request['percentage'])
            );

            $project_progress = ProjectProgress::create([
                'project_id' => $request['project_id'],
                'percentage' => $replacements['percentage'],
                'excerpt' => $request['content'],
                'body' => $request['content'],
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
