<?php

namespace App\Services;

use App\Models\Gallery;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GalleryUpdateService
{
    public function __construct(
        protected GalleryService $galleryService,
    ) {
        //
    }
    
    public function update(array $request, $gallery_id)
    {
        try {
            DB::beginTransaction();
            $old_gallery = Gallery::find($gallery_id);

            $this->galleryService->update($request, $gallery_id);
            
            if(isset($request['image_small'])){
                Storage::disk('gallery')->delete($old_gallery->image_small);
            }

            if(isset($request['image_large'])){
                Storage::disk('gallery')->delete($old_gallery->image_large);
            }

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
