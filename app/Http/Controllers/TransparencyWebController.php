<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransparencyWebController extends Controller{

    public function portal(){
        return view('web.transparency.portal');
    }
    
    public function environmentcouncil(){
        return view('web.transparency.environmentcouncil');
    }

    public function councilparticipation(){
        return view('web.transparency.councilparticipation');
    }
    
    public function environmentfund(){
        return view('web.transparency.environmentfund');
    }
    
    public function environmentaladjustment(){
        return view('web.transparency.environmentaladjustment');
    }
}