@extends('layouts.app')

@section('content')
<script src="https://use.fontawesome.com/14f1f2c704.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Villian Mail</h3></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                    <tr>
                        <th></th>
                        <th>From</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Delete</th>
                    </tr>
                    @foreach ($messages as $message)
                        <tr>
                            @if ($message->is_read === false)
                                <td>
                                    @if ($message->is_starred)

                                    <form method="post" action="/home/edit/{{ $message->id }}">
                                      {{ method_field('POST') }}
                                      {{ csrf_field() }}
                                        <button class="btn btn-xs btn-default space-right" type="submit"><strong style="color:red;">&#9734;</strong></button>
                                    </form>

                                    @else
                                    <form method="post" action="/home/edit/{{ $message->id }}">
                                      {{ method_field('POST') }}
                                      {{ csrf_field() }}

                                        <button class="btn btn-xs btn-default space-right" type="submit"><strong style="color:lightgrey;">&#9734;</strong></button>
                                    </form>



                                    @endif
                                </td>
                                <div>
                                    <td style="font-weight: bold"><a href="/home/{{ $message->id }}">{{ $message->sender->name }}</a></td>
                                
                                    <td style="font-weight: bold"><a href="/home/{{ $message->id }}">{{ $message->subject }}</a></td>
                                    <td style="font-weight: bold"><a href="/home/{{ $message->id }}">{{ $message->created_at->toDayDateTimeString() }}</a></td>
                                <div>
                            @else 
                                <td>
                                    @if ($message->is_starred) 
                                        <form method="post" action="/home/edit/{{ $message->id }}">
                                          {{ method_field('POST') }}
                                          {{ csrf_field() }}
                                            <button class="btn btn-xs btn-default space-right" type="submit"><strong style="color:red;">&#9734;</strong></button>
                                        </form>

                                        @else
                                        <form method="post" action="/home/edit/{{ $message->id }}">
                                          {{ method_field('POST') }}
                                          {{ csrf_field() }}
                                            <button class="btn btn-xs btn-default space-right" type="submit"><strong style="color:lightgrey;">&#9734;</strong></button>
                                        </form>
                                    @endif
                                </td>
                                <td><a href="/home/{{ $message->id }}">{{ $message->sender->name }}</a></td>
                                <td><a href="/home/{{ $message->id }}">{{ $message->subject }}</a></td>
                                <td><a href="/home/{{ $message->id }}">{{ $message->created_at->toDayDateTimeString() }}</a></td>
                                
                                <td>
                                  <form method="POST" action="/home/{{ $message->id }}/delete">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button class="btn btn-xs btn-default space-right" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                  </form>
                                </td>
                              
                            @endif

                        </tr>
                        @endforeach
                        
                       
                         <table class="table">
                         <h4 style="margin-top:40px">Sent Mail</h4>
                          <tr>
                            <th>To</th>

                            <th>Subject</th>
                            <th>Date</th>
                          </tr>
                          @foreach ($sent as $sender)
                          <tr>
                            <td><a href="/home/{{ $message->id }}">{{ $sender->recipient->name }}</a></td>
                            <td><a href="/home/{{ $message->id }}">{{ $sender->subject }}</a></td>
                            <td><a href="/home/{{ $message->id }}">{{ $sender->created_at->toDayDateTimeString() }}</a></td>
                          </tr>
                          @endforeach
                   

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
