<?php

namespace App\Services;

use App\Models\Media;
use App\Models\Post;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostUpdateService
{
    public function __construct(
        protected PostService $postService,
    ) {
        //
    }

    public function update(array $request, $post_id)
    {
        try {
            DB::beginTransaction();

            $post = Post::find($post_id);
            $medias = $post->media;
            $banner_lg_verification = false;
            $banner_sm_verification = false;

            foreach($medias as $media){
                if($media->type_media_id == 1 && $request['path_banner_lg'] != "not-file"){

                    Storage::disk('posts')->delete($media->url);

                    $mediaLocal = Media::find($media->id);
                    $mediaLocal->url = $request['path_banner_lg'];
                    $mediaLocal->save();
                    $banner_lg_verification = true;
                }
                if($media->type_media_id == 2 && $request['path_banner_sm'] != "not-file"){

                    Storage::disk('posts')->delete($media->url);

                    $mediaLocal = Media::find($media->id);
                    $mediaLocal->url = $request['path_banner_sm'];
                    $mediaLocal->save();
                    $banner_sm_verification = true;
                }
            }

            if(!$banner_lg_verification && $request['path_banner_lg'] != "not-file"){
                Media::create([
                    'post_id' => $post->id,
                    'type_media_id' => '1',
                    'url' => $request['path_banner_lg']
                ]);
            }

            if(!$banner_sm_verification && $request['path_banner_sm'] != "not-file"){
                Media::create([
                    'post_id' => $post->id,
                    'type_media_id' => '2',
                    'url' => $request['path_banner_sm']
                ]);
            }

            $post->user_id = $request['user_id'];
            if(isset($request['title'])){
                $post->title = $request['title'];
            }
            else{
                $post->title = '';
            }
            if(isset($request['sub_title'])){
                $post->sub_title = $request['sub_title'];
            }
            else{
                $post->sub_title = '';
            }
            $post->order = $request['order'];
            if(isset($request['title'])){
                $post->link = $request['link'];
            }
            else{
                $post->link = '';
            }
            $post->active = $request['active'];
            $post->save();



            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
