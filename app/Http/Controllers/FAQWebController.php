<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\BlankPage;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\ProjectCategory;

class FAQWebController extends Controller
{
    //
    public function index()
    {
        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $banner = Banner::where('banner_type_id', 2)->first();
        $faqs = Faq::where('status', 'PUBLISHED')->orderBy('question', 'asc')->get();
        $categories = ProjectCategory::orderBy('title', 'asc')->get();
        return view('web.faq.index', compact('categories', 'service_pages', 'institucional_pages', 'faqs', 'unit', 'copyright', 'banner'));
    }
}
