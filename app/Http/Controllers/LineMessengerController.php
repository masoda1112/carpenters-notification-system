<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use Illuminate\Support\Facades\Log;

class LineMessengerController extends Controller
{
    //
    public function webhook(Request $request) {
        // LINEから送られた内容を$inputsに代入
        $inputs=$request->all();

        $reply_token = $inputs['events'][0]['replyToken'];
        // そこからtypeをとりだし、$message_typeに代入
        $hook_type=$inputs['events'][0]['type'];

        // LINEBOTSDKの設定
        $http_client = new CurlHTTPClient(config('services.line.channel_token'));
        $bot = new LINEBot($http_client, ['channelSecret' => config('services.line.messenger_secret')]);

        $reply_message="";

        // メッセージが送られた場合、$message_typeは'message'となる。その場合処理実行。
        if($hook_type=='message') {
            // LINEのユーザーIDをuserIdに代入
            $clientId=$inputs['events'][0]['source']['userId'];
            $client=Client::where('line_id', $clientId)->first();
            // userIdがあるユーザーを検索
            // もし見つからない場合は、データベースに保存
            if($client==NULL) {
                $client=new Client();
                // $client->line_id=$inputs['events'][0]['source']['userId'];
                // $client->name=$inputs['events'][0]['message']['text'];
                $client->line_id=$clientId;
                $client->name=config('services.line.messenger_secret');
                $client->save();

                // 送信するメッセージの設定
                $reply_message=new TextMessageBuilder('ご返信ありがとうございます。登録が完了しました！これはサーバーから送られたメッセージです');
            }else{
                // 送信するメッセージの設定
                $reply_message=new TextMessageBuilder('ご返信ありがとうございます。すでに登録されております。');
            }
            return 'ok';
        }else{
            // 送信するメッセージの設定
            $reply_message=new TextMessageBuilder('ご返信ありがとうございます。申し訳ございませんが、文章を用いてお名前をご返信ください');
        }
        $reply=$bot->replyText($reply_token, $reply_message);
    }
}
