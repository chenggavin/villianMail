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

    public function store($message_id) {


       $message = new \App\Message;
       $message->sender_id = \Auth::user()->id;
       $message->recipient_id = request('senderName');
       $message->subject = request('subject');
       $message->body = request('reply');
       $message->is_read = false;
       $message->is_starred = false;
       $message->save();

       return redirect('/home');
    }
    public function update($message_id)
    {
        $messages = \App\Message::where('recipient_id', \Auth::user()->id )->orderBy('created_at', 'desc')->get();
        if ($messages->is_starred === true) {
            $messages->is_starred = false;
        }

        else {
            $messages->is_starred = true;
        }
        
        

         return view('home', compact('messages'));

    }




}
