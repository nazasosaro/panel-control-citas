<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{

    public function appointments()
    {
        return view('front.appointments');
    }

}