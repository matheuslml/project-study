<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Copyright;
use Illuminate\Http\Request;

class ComponentsController extends Controller
{
    // Component accordion
    public function accordion()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Accordion"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-accordion', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component Alert
    public function alert()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Alerts"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-alerts', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component - Avatar
    public function avatar()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Avatar"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-avatar', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component Badges
    public function badges()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Badges"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-badges', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component Breadcrumbs
    public function breadcrumbs()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Breadcrumbs"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-breadcrumbs', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component Buttons
    public function buttons()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Buttons"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-buttons', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component Carousel
    public function carousel()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Carousel"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-carousel', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component Collapse
    public function collapse()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Collapse"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-collapse', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component - Divider
    public function divider()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Divider"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-divider', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component Dropdowns
    public function dropdowns()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Dropdowns"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-dropdowns', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component List Group
    public function list_group()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "List Group"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-list-group', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component Modals
    public function modals()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Modals"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-modals', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component Navs
    public function navs()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Navs"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-navs', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component offcanvas
    public function offcanvas()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "OffCanvas"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-offcanvas', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component Pagination
    public function pagination()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Pagination"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-pagination', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component Pill Badges
    public function pill_badges()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Pill Badges"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-pill-badges', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component Pills
    public function pills()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Pills"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-pills', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component Tabs
    public function tabs()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Tabs"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-tabs', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }


    // Component Tooltips
    public function tooltips()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Tooltips"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-tooltips', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component Popovers
    public function popovers()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Popovers"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-popovers', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component Progress
    public function progress()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Progress"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-progress', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component Spinner
    public function spinner()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Spinner"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-spinner', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component Timeline
    public function timeline()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Timeline"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-timeline', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Component Toast
    public function toast()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Components"], ['name' => "Toasts"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/components/component-bs-toast', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }
}
