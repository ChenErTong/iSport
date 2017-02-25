@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                    <form class="form-horizontal col-md-offset-3 col-md-12" role="form" method="POST" action="{{ url('/community/release') }}">
                        {{ csrf_field() }}
                        <label>Share your moment!</label>
                        <div class="form-group">
                            <div class="col-md-10">
                                <textarea id="moment" type="text" class="form-control" name="moment" style="height: 100px;" value="{{ old('moment') }}" required autofocus></textarea>
                            </div>
                        </div>
                        <button class="btn btn-default" type="submit" style="margin-left: 72.5%; margin-top: -1.5%">release</button>
                    </form>
            </div>
        </div>
        @foreach($moments as $moment)
            <div class="row" style="margin-top: 2%">
                <div class="col-md-8" style="margin-left: 3%">
                    <form class="form-horizontal col-md-offset-3 col-md-12" role="form" method="POST" action="{{ url('/community/comment?id='.$moment->id) }}">
                        {{ csrf_field() }}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>{{ $moment->host }}: </strong>{{ $moment->content }}</br>
                                <div class="date"><small>{{ $moment->created_at }}</small></div>
                            </div>
                            @foreach($moment->comments as $comment)
                                <div class="panel-heading comment">
                                    {{ $comment->host }}: {{$comment->content}}</br>
                                    <div class="date"><small>{{ $comment->created_at }}</small></div>
                                </div>
                            @endforeach
                            <div class="panel-body">
                                <textarea type="text" class="form-control" style="width: 104.3%;margin: -2.1%;border-style: hidden" name="comment" value="{{ old('comment') }}" placeholder="Comment this moment..." required></textarea>
                            </div>
                        </div>
                        <button class="btn btn-default" type="submit" style="margin-left: 87.7%; margin-top: -3%">comment</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
