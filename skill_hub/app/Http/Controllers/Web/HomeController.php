<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cat;

class HomeController extends Controller
{
    public function index(){
        return view('web.home.index');
    }
}
