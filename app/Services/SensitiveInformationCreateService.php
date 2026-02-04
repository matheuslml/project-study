<?php

namespace App\Services;

use App\Models\SensitiveInformation;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SensitiveInformationCreateService
{
    public function __construct(
        protected SensitiveInformationService $projectService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();
            
            $project = SensitiveInformation::create([
                'title' => $request['title'],
                'description' =>$request['description'],
                'category_id' => $request['category_id'],
                'responsible_id' => $request['responsible_id'],
                'archive' => isset($request['path']) ? $request['path']  : '',
                'excerpt' => $request['content'],
                'body' => $request['content']
            ]);

           


            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
