<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Copyright;
use Illuminate\Http\Request;

class ChartsController extends Controller
{
    // Apex Charts
    public function apex()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Charts & Maps"], ['name' => "Apex"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('/content/charts-maps/chart-apex', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Chartjs Charts
    public function chartjs()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Charts & Maps"], ['name' => "Chartjs"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/charts-maps/chart-chartjs', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Google Maps
    public function maps_leaflet()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Maps"], ['name' => "Leaflet Maps"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/charts-maps/maps-leaflet', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }
}
