<?php

namespace App\Services;

use App\Models\BlankPage;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlankPageCreateService
{
    public function __construct(
        protected BlankPageService $blankPageService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();

            BlankPage::create([
                'blank_page_type_id' => $request['blank_page_type_id'],
                'title' => $request['title'],
                'link_url' => isset($request['link_url']) ? $request['link_url']  : '',
                'only_link' => isset($request['only_link']) ? true  : false,
                'excerpt' => $request['content'],
                'body' => $request['content'],
                'image' => isset($request['path']) ? $request['path']  : '',
                'meta_description' => $request['content'],
                'meta_keywords' => $request['meta_keywords'] != null ? $request['meta_keywords'] : $request['title'],
                'status' => $request['status'],
                'description' =>$request['description']
            ]);

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            dd($exception);
            throw new Exception($exception);
        }
    }
}
