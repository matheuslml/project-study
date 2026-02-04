<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\BlankPage;
use App\Models\Category;
use App\Models\Copyright;
use App\Models\OfficialDiary;
use App\Models\Unit;
use App\Models\WebFooter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;


class OfficialDiarySearchController extends Controller
{
    public function index()
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 14)->first();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        $categories = Category::orderBy('title')->get();

        $official_diary_latest = OfficialDiary::published()->edition()->first();
        $official_diary_first = OfficialDiary::published()->edition('ASC')->first();

        $official_diaries_builder = OfficialDiary::published()->edition();

        $official_diaries_builder = $this->parseSearch(
            $official_diaries_builder,
            $official_diary_first,
            $official_diary_latest
        );

        $official_diaries = $official_diaries_builder->paginate(10)->withQueryString();

        return view(
            'web.official_diary.index',
            compact(
                'official_diaries',
                'official_diary_latest',
                'official_diary_first',
                'categories',
                'service_pages',
                'institucional_pages',
                'banner',
                'unit',
                'copyright',
                'web_footer'
            )
        );
    }

    /**
     * @param Builder $official_diaries_builder
     * @param OfficialDiary $official_diary_first
     * @param OfficialDiary $official_diary_latest
     * @return Builder
     */
    private function parseSearch(
        Builder $official_diaries_builder,
        OfficialDiary $official_diary_first,
        OfficialDiary $official_diary_latest
    ): Builder {
        if (!request()?->has('filter.text')) {
            return $official_diaries_builder;
        }

        $text = request('filter.text');

        $isInt = filter_var($text, FILTER_VALIDATE_INT);

        $official_diaries_builder->where(
            function (Builder $query) use ($official_diary_first, $official_diary_latest) {
                [$start, $end] = $this->getDates(
                    $official_diary_first,
                    $official_diary_latest
                );
                $query->whereBetween(
                    'published_at',
                    [
                        $start->format('Y-m-d'),
                        $end->format('Y-m-d')
                    ]
                );
            }
        );

        if ($isInt) {
            return $official_diaries_builder->where('edition', $isInt);
        }

        if(empty($text)){
            return $official_diaries_builder;
        }

        return $official_diaries_builder->where(function (Builder $query) {
            $text = request('filter.text');
            $query->orWhereFullText('content', $text)
                ->orWhereFullText('description', $text);
        });
    }

    /**
     * @param OfficialDiary $official_diary_first
     * @param OfficialDiary $official_diary_latest
     * @return array
     */
    private function getDates(OfficialDiary $official_diary_first, OfficialDiary $official_diary_latest): array
    {
        $explodeDates = explode(' - ', request('filter.daterange'));
        if (count($explodeDates) !== 2) {
            return [
                $official_diary_first->published_at,
                $official_diary_latest->published_at
            ];
        }
        [$start, $end] = $explodeDates;
        return [
            Carbon::createFromFormat(
                'd/m/Y',
                $start
            ),

            Carbon::createFromFormat(
                'd/m/Y',
                $end
            ),
        ];
    }

}
