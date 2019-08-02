<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Entities\User;
use App\Entities\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Message::with('user')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = \Auth::user()->messages()->create([
            'message' => $request->message,
        ])->load('user');
        broadcast(new MessageSent($message))->toOthers();
        return response()->json($message);
    }
}
