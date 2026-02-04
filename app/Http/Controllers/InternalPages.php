<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

use App\Models\Banner;
use App\Models\BlankPage;
use App\Models\Faq;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\ProjectCategory;
use App\Models\WebFooter;

class InternalPages extends Controller
{

    public function links_uteis(): View
    {

        try{
            $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
            $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $banner = Banner::where('banner_type_id', 2)->first();
            $categories = ProjectCategory::orderBy('title', 'asc')->get();
            $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
            return view('web.internal_pages.links', compact('web_footer', 'categories', 'service_pages', 'institucional_pages', 'unit', 'copyright', 'banner'));
        } catch (\Throwable $throwable) {
            flash('Erro ao abrir Os links úteis!')->error();
            return redirect()->back()->withInput();
        }
    }
}
