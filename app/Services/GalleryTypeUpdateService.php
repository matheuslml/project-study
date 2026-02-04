<?php

namespace App\Services;

use App\Models\GalleryType;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GalleryTypeUpdateService
{
    public function __construct(
        protected GalleryTypeService $galleryTypeService,
    ) {
        //
    }

    public function update(array $request, $galleryType_id)
    {
        try {
            DB::beginTransaction();
            $old_galleryType = GalleryType::find($galleryType_id);

            $this->galleryTypeService->update($request, $galleryType_id);

            if(isset($request['image_small'])){
                Storage::disk('galleryType')->delete($old_galleryType->image_small);
            }

            if(isset($request['image_large'])){
                Storage::disk('galleryType')->delete($old_galleryType->image_large);
            }

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
