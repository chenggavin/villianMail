<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $messages = \App\Message::all();
    //     return view('home', compact('messages'));
    // }


    public function index()
    {
        $messages = \App\Message::where('recipient_id', \Auth::user()->id )->orderBy('created_at', 'desc')->get();

         return view('home', compact('messages'));

    }


    public function show($message_id) {

        $messages = \App\Message::where([
            ['recipient_id', '=', \Auth::user()->id],
            ['id', '=', ($message_id)]])->get();

         $messages->is_read = \App\Message::where('id', $message_id)->update(['is_read' => true]);

        return view('message', compact('messages'));
    }


}
