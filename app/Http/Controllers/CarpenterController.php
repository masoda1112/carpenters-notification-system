<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarpenterController extends Controller
{
    //
    public function index(){
        return view('carpenters');
    }

    public function show(){
        return view('carpenter');
    }

    public function new(){
        return view('newcarpenter');
    }
}
