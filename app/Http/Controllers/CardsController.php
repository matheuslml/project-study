<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Copyright;
use Illuminate\Http\Request;

class CardsController extends Controller
{
  // Card Basic
  public function card_basic()
  {


        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
    $breadcrumbs = [
      ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Card"], ['name' => "Basic Card"]
    ];
    return view('/content/cards/card-basic', [
      'breadcrumbs' => $breadcrumbs
    ], compact('unit', 'copyright'));
  }

  // Card Advance
  public function card_advance()
  {


        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
    $breadcrumbs = [
      ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Card"], ['name' => "Advance Card"]
    ];
    return view('/content/cards/card-advance', [
      'breadcrumbs' => $breadcrumbs
    ], compact('unit', 'copyright'));
  }

  // Card Statistics
  public function card_statistics()
  {


        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
    $breadcrumbs = [
      ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Card"], ['name' => "Statistics Cards"]
    ];
    return view('/content/cards/card-statistics', [
      'breadcrumbs' => $breadcrumbs
    ], compact('unit', 'copyright'));
  }

  // Card Analytics
  public function card_analytics()
  {


        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
    $breadcrumbs = [
      ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Card"], ['name' => "Analytics Cards"]
    ];
    return view('/content/cards/card-analytics', [
      'breadcrumbs' => $breadcrumbs
    ], compact('unit', 'copyright'));
  }

  // Card Actions
  public function card_actions()
  {


        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();
    $breadcrumbs = [
      ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Card"], ['name' => "Card Actions"]
    ];
    return view('/content/cards/card-actions', [
      'breadcrumbs' => $breadcrumbs
    ], compact('unit', 'copyright'));
  }
}
