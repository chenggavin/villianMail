<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PleaseWorkController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = \App\Message::where('recipient_id', \Auth::user()->id )->orderBy('created_at', 'desc')->get();

        $sent = \App\Message::where('sender_id', \Auth::user()->id )->orderBy('created_at', 'desc')->get();


         return view('home', compact('messages','sent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($message_id)
    {
        $messages = \App\Message::where([
            ['recipient_id', '=', \Auth::user()->id],
            ['id', '=', ($message_id)]])->get();

        $messages = \App\Message::where('recipient_id', \Auth::user()->id )->orderBy('created_at', 'desc')->get();

        $sent = \App\Message::where('sender_id', \Auth::user()->id )->orderBy('created_at', 'desc')->get();


         return view('home', compact('messages','sent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $message = \App\Message::find($id);
        if ($message->is_starred === true) {
            $message->is_starred = false;
        }

        else {
            $message->is_starred = true;
        }
        
        $message->save();

        $messages = \App\Message::where('recipient_id', \Auth::user()->id )->orderBy('created_at', 'desc')->get();

        $sent = \App\Message::where('sender_id', \Auth::user()->id )->orderBy('created_at', 'desc')->get();


         return view('home', compact('messages','sent'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $messages = \App\Message::find($id);
        $messages->delete();
        return redirect('/home');
    }
}
