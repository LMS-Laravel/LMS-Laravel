<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Entities\{User, Course, Lesson, Message};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($resource = $this->findResource($request->type, $request->resource)) {
            return response()->json($resource->messages);
        }
        return response()->json(Message::with('user')->whereNull('messageable_id')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $message = \Auth::user()->messages()->create([
                'message' => $request->message,
            ])->load('user');

            if($resource = $this->findResource($request->type, $request->resource)){
                $resource->messages()->save($message);
            }
            DB::commit();
            broadcast(new MessageSent($message))->toOthers();
            return response()->json($message);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(false);
        }
    }

    public function findResource($type, $id)
    {
        if($id){
            $class = 'App\\Entities\\'.Str::ucfirst($type);
            return $class::find($id);
        }
    }
}
