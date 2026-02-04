<?php

namespace App\Services;

use App\Models\WebFooterLogo;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class WebFooterLogoUpdateService
{
    public function __construct(
        protected WebFooterLogoService $webFooterLogoService,
    ) {
        //
    }

    public function update(array $request, $web_footer_logo_id)
    {
        try {
            DB::beginTransaction();

            $web_footer_logo = WebFooterLogo::find($web_footer_logo_id);
            $old_path = $web_footer_logo->logo_url;

            $this->webFooterLogoService->update($request, $web_footer_logo_id);

            if(isset($request['path'])){
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
