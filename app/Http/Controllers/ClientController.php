<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function index(){
        return view('clients');
    }

    public function show(){
        return view('client');
    }

    public function new(){
        return view('newclient');
    }
}
