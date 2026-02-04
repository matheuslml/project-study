<?php

namespace App\Services;

use App\Models\About;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AboutUpdateService
{
    public function __construct(
        protected AboutService $aboutService,
    ) {
        //
    }
    
    public function update(array $request, $about_id)
    {
        
        try {
            DB::beginTransaction();
            if($about_id != 0){
                $old_about = About::find($about_id);
            }
            if(isset($request['image'])){
                About::updateOrCreate(
                    ['id' => $about_id],
                    [
                        'unit_id' => $request['unit_id'], 
                        'title' => $request['title'],
                        'sub_title' => $request['sub_title'],
                        'description' => $request['description'],
                        'founded_at' => $request['founded_at'],
                        'image' => $request['image'],
                        'body' => $request['body'],
                        'status' => $request['status']
                    ]
                );
                if($about_id != 0){
                    Storage::disk('about')->delete($old_about->image);
                }
            }
            else{

                About::updateOrCreate(
                    ['id' => $about_id],
                    [
                        'unit_id' => $request['unit_id'], 
                        'title' => $request['title'],
                        'sub_title' => $request['sub_title'],
                        'description' => $request['description'],
                        'founded_at' => $request['founded_at'],
                        'body' => $request['body'],
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
