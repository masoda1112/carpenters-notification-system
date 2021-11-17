<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carpenter;
use App\Http\Requests\CarpenterRequest;

class CarpenterController extends Controller
{
    //
    public function index(){
        $carpenters = Carpenter::all();
        $test = "テスト";
        return view('carpenters')->with(['carpenters' => $carpenters]);
    }

    public function show(Carpenter $carpenter){
        return view('carpenter')->with(['carpenter' => $carpenter]);
    }

    public function new(){
        return view('newcarpenter');
    }

    public function create(CarpenterRequest $request){
        $carpenter = new Carpenter();
        $carpenter->name = $request->name;
        $carpenter->profile = $request->profile;
        // $image_path = $request->file('img')->store('public/');
        // $carpenter->img = $image_path;
        // var_dump(base64_encode(file_get_contents($request->img->getRealPath())));
        $carpenter->img = base64_encode(file_get_contents($request->img->getRealPath()));
        $carpenter->role = $request->role;
        $carpenter->save();
        return redirect('/carpenters');
    }

    public function update(CarpenterRequest $request, Carpenter $carpenter){
        $carpenter->name = $request->name;
        $carpenter->profile = $request->profile;
        if($request->img != null){
            $image_path = $request->file('img')->store('public/');
            $carpenter->img = basename($image_path);
        }
        $carpenter->role = $request->role;
        $carpenter->save();
        return redirect('/carpenters');
    }

    public function destroy(Carpenter $carpenter){
        $carpenter->delete();
        return redirect('/carpenters');
    }
}
