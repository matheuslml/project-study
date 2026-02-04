<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicationWebController extends Controller
{
    //
    public function home()
    {
       return view('web.publication.home');
    }

    public function researchs()
    {
        return view('web.publication.researchs');
    }
}
