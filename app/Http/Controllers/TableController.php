<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Copyright;
use Illuminate\Http\Request;

class TableController extends Controller
{
    // Bootstrap Table
    public function table()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['name' => "Table Bootstrap"]];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/table/table-bootstrap/table-bootstrap', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }

    // Datatable Basic
    public function datatable_basic()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Datatable"], ['name' => "Basic"]];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/table/table-datatable/table-datatable-basic', ['breadcrumbs' => $breadcrumbs], compact('unit', 'copyright'));
    }

    // Datatable Basic
    public function datatable_advance()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Datatable"], ['name' => "Advanced"]
        ];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/table/table-datatable/table-datatable-advance', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright'));
    }
}
