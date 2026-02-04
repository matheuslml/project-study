<?php

namespace App\Services;

use App\Models\BlankPage;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\BlankPageTag;
use Illuminate\Support\Facades\Storage;

class BlankPageUpdateService
{
    public function __construct(
        protected BlankPageService $blankPageService,
    ) {
        //
    }

    public function update(array $request, $blankPage_id)
    {
        try {
            DB::beginTransaction();

            $blankPage = BlankPage::find($blankPage_id);
            $old_path = $blankPage->image;

            $blankPage->blank_page_type_id = $request['blank_page_type_id'];
            $blankPage->title = $request['title'];
            $blankPage->link_url = isset($request['link_url']) ? $request['link_url']  : '';
            $blankPage->only_link = isset($request['only_link']) ? true : false;
            $blankPage->excerpt = $request['content'];
            $blankPage->body = $request['content'];
            $blankPage->image = isset($request['path']) ? $request['path']  : $old_path;
            $blankPage->meta_description = $request['content'];
            $blankPage->meta_keywords = $request['meta_keywords'];
            $blankPage->status = $request['status'];
            $blankPage->save();



            if(isset($request['path'])){
                Storage::disk('blankpages')->delete($old_path);
            }

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
