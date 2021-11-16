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

        // そこからtypeをとりだし、$message_typeに代入
        $hook_type=$inputs['events'][0]['type'];

        $client=new Client();
        $client->line_id=$request['events'][0]['source']['userId'];
        $client->name=$inputs['events'][0]['type'];
        $client->save();

        // メッセージが送られた場合、$message_typeは'message'となる。その場合処理実行。
        if($hook_type=='message') {
            // replyTokenを取得
            $reply_token=$inputs['events'][0]['replyToken'];

            // LINEBOTSDKの設定
            $http_client = new CurlHTTPClient(config('services.line.channel_token'));
            $bot = new LINEBot($http_client, ['channelSecret' => config('services.line.messenger_secret')]);

            // 送信するメッセージの設定
            $reply_message='ご返信ありがとうございます。登録が完了しました！これはサーバーから送られたメッセージです';

            // ユーザーにメッセージを返す
            $reply=$bot->replyText($reply_token, $reply_message);
            // Log::debug('$findData="' .$inputs. '"');

            // LINEのユーザーIDをuserIdに代入
            $clientId=$request['events'][0]['source']['userId'];
            // userIdがあるユーザーを検索
            $client=Client::where('line_id', $userId)->first();
            // もし見つからない場合は、データベースに保存
            if($client==NULL) {
                $client=new Client();
                $client->line_id=$clientId;
                $client->name=$request['events'][0]['message']['text'];
                $client->save();
            }
            return 'ok';
        }

    }
}
