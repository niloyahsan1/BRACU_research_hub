<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewUserDashBoard extends Controller
{
    

    ///
    public function reviewer(){
        return view('reviewer.dashboard');
    }

    public function researcher(){
        return view('researcher.dashboard');
    }
}
