<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function send($emailForWho, $name, $answer)
    {
        Mail::send(['text' => 'mail'], [
            'data'=> [
                'name' => $name,
                'message' => $answer,
            ]
        ], function ($message) use ($emailForWho) {
            $message->to($emailForWho, 'От кого')->subject($emailForWho);
            $message->from('SQUADCC12@yandex.ru');
        });
    }
}
