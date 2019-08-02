<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Entities\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('messages');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalUsers = User::all()->count();
        return view('home', compact('totalUsers'));
    }

    /**
     * Show stream and chat
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function stream()
    {
        return view('stream');
    }

}
