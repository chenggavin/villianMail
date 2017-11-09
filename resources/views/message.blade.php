@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">welcome.</div>

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
                    </tr>
                    @foreach ($messages as $message)
                    <tr>
                        <td>
                            @if ($message->is_starred) 
                                <strong>&#9734;</strong>
                            @endif
                        </td>
                        <td>{{ $message->sender->name }}</td>
                        <td>{{ $message->subject }}</td>
                        <td>{{ $message->created_at->toDayDateTimeString() }}</td>
                    </tr>

                </table>
                <br>message:
                <table class="table">
                    <tr>
                        <td>{{ $message->body }} </td>
                    </tr>
                </table>
                <h4 style="margin-top:50px;"><strong>reply:</strong></h4>


                    <form method="POST" action="/home/{{$message->id}}">
                        {{ csrf_field() }}
                      <div class="form-group" style="margin-top:10px;">
                        <label for="subject">subject</label>
                        <input class="form-control" id="subject" name="subject" for ="subject" rows="1"></input>
                      </div>
                      <div class="form-group" style="margin-top:10px;">
                        <label for="reply">message</label>
                        <textarea class="form-control" id="reply" name="reply" for ="reply" rows="2"></textarea>
                        <input type="hidden" id="senderName" name="senderName" for ="senderName" value="{{ $message->sender_id }}"></input>
                      </div>
                      <button type="submit" style="float:right;" class="btn btn-primary">send.</button>
                    </form>
    


                    @endforeach

                    <a style="font-size:15px; font-weight:bold;" href="\home">back to home.</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
