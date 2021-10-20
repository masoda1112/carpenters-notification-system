<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SentenceController extends Controller
{
    //
    public function index(){
        return view('sentences');
    }

    public function show(){
        return view('sentence');
    }

    public function new(){
        return view('newsentence');
    }
}
