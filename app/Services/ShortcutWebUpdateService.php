<?php

namespace App\Services;

use App\Models\ShortcutWeb;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ShortcutWebUpdateService
{
    public function __construct(
        protected ShortcutWebService $shortcutWebService,
    ) {
        //
    }

    public function update(array $request, $shortcutWeb_id)
    {
        try {
            DB::beginTransaction();
            if($shortcutWeb_id != 0){
                $old_ShortcutWeb = ShortcutWeb::find($shortcutWeb_id);
            }
            if(isset($request['img_url'])){
                ShortcutWeb::updateOrCreate(
                    ['id' => $shortcutWeb_id],
                    [
                        'title' => $request['title'],
                        'img_url' => $request['img_url'],
                        'link_url' => $request['link_url'],
                        'order' => $request['order'],
                        'status' => $request['status']
                    ]
                );
                if($shortcutWeb_id != 0){
                    Storage::disk('shortcutweb')->delete($old_ShortcutWeb->img_url);
                }
            }
            else{

                ShortcutWeb::updateOrCreate(
                    ['id' => $shortcutWeb_id],
                    [
                        'title' => $request['title'],
                        'link_url' => $request['link_url'],
                        'order' => $request['order'],
                        'status' => $request['status']
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
