<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Requests\ClientRequest;


class ClientController extends Controller
{
    //
    public function index(){
        $clients = Client::all();
        return view('clients')->with(['clients'=>$clients]);
    }

    public function show(Client $client){
        return view('client')->with(['client'=>$client]);
    }

    public function new(){
        return view('newclient');
    }

    public function create(ClientRequest $request){
        $client = new Client();
        $client->name = $request->name;
        $client->line_id = $request->line_id;
        $client->save();
        return redirect('/clients');
    }

    public function update(ClientRequest $request, Client $client){
        $client->name = $request->name;
        $client->line_id = $request->line_id;
        $client->save();
        return redirect('/clients');
    }

    public function destroy(Client $client){
        $client->delete();
        return redirect('/clients');
    }
}
