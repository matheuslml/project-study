<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegislationWebController extends Controller
{
    //
    public function index()
    {
       return view('web.legislation.index');
    }
}
