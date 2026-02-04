<?php

namespace App\Services;

use App\Models\News;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\NewsTag;
use Illuminate\Support\Facades\Storage;

class NewsUpdateService
{
    public function __construct(
        protected UserService $userService,
        protected BiddingService $biddingService,
        protected NewsService $newsService,
    ) {
        //
    }

    /**
     * @throws Exception
     */
    public function update(array $request, $news_id)
    {
        try {
            DB::beginTransaction();

            $news = News::find($news_id);
            $news->fill($request);

            $old_path = $news->image;
            $news->image = isset($request['path']) ? $request['path']  : $old_path;
            $news->save();


            $old_tags = NewsTag::where('news_id', $news_id)->get();

            foreach($old_tags as $tagdelete){
                $tagdelete->forceDelete();
            }

            if(isset($request['tags'])){
                foreach ($request['tags'] as  $tag) {
                    $tag_id = $tag;

                    NewsTag::create([
                        'news_id' => $news->id,
                        'tag_id' => $tag_id,
                    ]);
                }
            }

            if(isset($request['path'])){
                Storage::disk('news')->delete($old_path);
            }

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
