<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function index(){
        return view('home');
    }

    public function show(){
        return view('message');
    }

    public function new(){
        return view('newmessage');
    }
}
