<?php

namespace App\Services;

use App\Models\Banner;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BannerUpdateService
{
    public function __construct(
        protected UserService $userService,
        protected BannerService $bannerService,
    ) {
        //
    }
    
    public function update(array $request, $type_id)
    {
        try {
            DB::beginTransaction();
            
            Banner::updateOrCreate(
                ['banner_type_id' => $type_id],
                [
                    'title' => $request['title'], 
                    'image' => $request['path'],
                    'status' => $request['status'],
                ]
            );

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
