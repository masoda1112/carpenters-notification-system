<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carpenter;
use App\Http\Requests\CarpenterRequest;
use JD\Cloudder\Facades\Cloudder;

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
        var_dump($request,$carpenter);
        // $carpenter->name = $request->name;
        // $carpenter->profile = $request->profile;
        // $image_path = $request->img->getRealPath();
        // Cloudder::upload($image_path, null);
        // $publicId = Cloudder::getPublicId();
        // $logoUrl = Cloudder::secureShow($publicId, [
        //     'width'     => 500,
        //     'height'    => 500
        // ]);
        // $carpenter->img = $logoUrl;
        // $carpenter->cloudinary_public_id = $publicId;
        // // $carpenter->img = base64_encode(file_get_contents($request->img->getRealPath()));
        // $carpenter->role = $request->role;
        // $carpenter->save();
        // return redirect('/carpenters');
    }

    public function update(CarpenterRequest $request, Carpenter $carpenter){
        $carpenter->name = $request->name;
        $carpenter->profile = $request->profile;
        if($request->img != null){
            $image_path = $request->img->getRealPath();
            Cloudder::upload($image_path, null);
            $publicId = Cloudder::getPublicId();
            $logoUrl = Cloudder::secureShow($publicId, [
                'width'     => 500,
                'height'    => 500
            ]);
            $carpenter->img = $logoUrl;
            $carpenter->cloudinary_public_id = $publicId;
        }
        $carpenter->role = $request->role;
        $carpenter->save();
        return redirect('/carpenters');
    }

    // create、updateの共通部分をまとめる
    public function createHelper(CarpenterRequest $request,Carpenter $carpenter){

    }

    public function destroy(Carpenter $carpenter){
        Cloudder::destroyImage($carpenter->cloudinary_public_id);
        $carpenter->delete();
        return redirect('/carpenters');
    }
}
