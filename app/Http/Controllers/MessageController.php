<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Client;
use App\Models\Carpenter;
use App\Models\Template;
use App\Http\Requests\MessageRequest;

class MessageController extends Controller
{

    /**
     * MessageController constructor.
     * @param Message $item
     */
    //
    public function index(){
        $messages = Message::all();
        return view('home')->with(['messages'=>$messages]);
    }

    public function show(Message $message){
        $clients = Client::all();
        $carpenters = Carpenter::all();
        $templates = Template::all();
        $selectedclient = $message->client;
        $selectedcarpenters = [];
        foreach ($message->carpenters as $carpenter) {
            array_push($selectedcarpenters,$carpenter);
        }

        return view('message')->with(
            [
                'message'=>$message,
                'clients'=>$clients,
                'selectedclient'=>$selectedclient,
                'carpenters'=>$carpenters,
                'selectedcarpenters'=>$selectedcarpenters,
                'templates'=>$templates
            ]
        );
    }

    public function new(){
        $clients = Client::all();
        $carpenters = Carpenter::all();
        $templates = Template::all();
        return view('newmessage')->with(['clients'=>$clients,'carpenters'=>$carpenters,'templates'=>$templates]);
    }

    public function create(MessageRequest $request){
        $message = new Message();
        $message->client_id = $request->client;
        $message->date = $request->date;
        $message->message = $request->message;
        $message->status = 0;
        $message->save();
        $lastmessage = Message::latest()->first();
        $lastmessage->carpenters()->attach($request->carpenters);
        $lastmessage->save();
        return redirect('/home');
    }

    public function update(MessageRequest $request, Message $message){
        $message->client_id = $request->client;
        $message->date = $request->date;
        $message->message = $request->message;
        $message->status = 0;
        $message->save();
        $lastmessage = Message::latest()->first();
        $lastmessage->carpenters()->detach();
        $lastmessage->carpenters()->attach($request->carpenters);
        $lastmessage->save();
        return redirect('/home');
    }

    public function destroy(Message $message){
        $message->delete();
        return redirect('/home');
    }

    public function importcsv(MessageRequest $request){
        $file_path = $request->file('csvfile')->path();
        $file = new \SplFileObject($file_path);
        $file->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );
        foreach($file as $line)
        {
            // これで値取れるから、messageオブジェクトを作成する
            $i = 3;
            $carpenters = [];
            while($i < 13){
                array_push($carpenters,$line[$i]);
                $i += 1;
            }
            $carpenters = array_diff($carpenters, array(0));
            $data = [
                'client_id'=> (int)$line[0],
                'date'=>date('Y-m-d', strtotime($line[1])),
                'message'=> $line[2],
                'carpenters'=>$carpenters,
            ];
            $message = new Message();
            $message->client_id = $data['client_id'];
            $message->date = $data['date'];
            $message->message = $data['message'];
            $message->status = 0;
            $message->save();
            $lastmessage = Message::latest()->first();
            $lastmessage->carpenters()->attach($data['carpenters']);
            $lastmessage->save();
        }
        return redirect('/home');
    }
}
