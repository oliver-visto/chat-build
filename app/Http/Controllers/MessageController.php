<?php

namespace App\Http\Controllers;

use App\Events\MessageNotification;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function send_message(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'message' => 'required|string'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'Message' => 'Send message failed',
                'Errors' => $validator->errors()
            ]);
        }
        if($request->user == null)
        {
            $request->user = 'guest';
        }
        Message::create([
            'user' => $request->user,
            'messages' => $request->message]);
        event(new MessageNotification($request->user,$request->message));
    }
}
