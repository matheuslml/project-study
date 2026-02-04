<?php

namespace App\Services;

use App\Models\News;
use App\Models\NewsTag;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsCreateService
{
    public function __construct(
        protected UserService $userService,
        protected BiddingService $biddingService,
        protected NewsService $newsService,
    ) {
        //
    }

    public function create(array $request)
    {
        try {
            DB::beginTransaction();

            $news = News::create([
                'user_id' => $request['user_id'],
                'category_id' => $request['category_id'],
                'title' => $request['title'],
                'excerpt' => $request['content'],
                'body' => $request['content'],
                'image' => isset($request['path']) ? $request['path']  : '',
                'meta_description' => $request['content'],
                'meta_keywords' => $request['meta_keywords'] != null ? $request['meta_keywords'] : $request['title'],
                'status' => $request['status'],
                'description' =>$request['description']
            ]);

            if(isset($request['tags'])){
                foreach ($request['tags'] as $tag) {
                    NewsTag::create([
                        'news_id' => $news->id,
                        'tag_id' => $tag
                    ]);
                }
            }

            DB::commit();
        } catch (Exception $exception) {
            //Bugsnag::notifyException($exception);
            DB::rollBack();
            throw new Exception($exception);
        }
    }
}
