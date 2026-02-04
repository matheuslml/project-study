<?php

namespace App\Services;

use App\Models\WebFooter;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class WebFooterUpdateService
{
    public function __construct(
        protected WebFooterService $webFooterService,
    ) {
        //
    }

    public function update(array $request, $web_footer_id)
    {
        try {
            DB::beginTransaction();

            $web_footer = WebFooter::find($web_footer_id);
            $old_path = $web_footer->float_icon_url;

            $this->webFooterService->update($request, $web_footer_id);


            if(isset($request['float_icon_url'])){
                Storage::disk('webfooters')->delete($old_path);
            }

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
