<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Copyright;
use Illuminate\Http\Request;

class PageLayoutController extends Controller
{

    // Collapsed Menu Layout
    public function layout_collapsed_menu()
    {
        $pageConfigs = ['sidebarCollapsed' => true];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Layouts"], ['name' => "Collapsed menu"]];
        return view('/content/page-layouts/layout-collapsed-menu', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs], compact('unit', 'copyright'));
    }

    // Boxed Layout
    public function layout_full()
    {
        $pageConfigs = ['layoutWidth' => 'full'];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Layouts"], ['name' => "Layout Full"]];
        return view('/content/page-layouts/layout-full', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs], compact('unit', 'copyright'));
    }
    // Layout Without Menu
    public function layout_without_menu()
    {
        $pageConfigs = ['showMenu' => false];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Layouts"], ['name' => "Layout without menu"]];
        return view('/content/page-layouts/layout-without-menu', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs], compact('unit', 'copyright'));
    }
    // Empty Layout
    public function layout_empty()
    {

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Layouts"], ['name' => "Layout Empty"]];
        return view('/content/page-layouts/layout-empty', ['breadcrumbs' => $breadcrumbs], compact('unit', 'copyright'));
    }
    // Blank Layout
    public function layout_blank()
    {
        $pageConfigs = ['blankPage' => true];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Layouts"], ['name' => "Layout Blank"]];
        return view('/content/page-layouts/layout-blank', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs], compact('unit', 'copyright'));
    }
}
