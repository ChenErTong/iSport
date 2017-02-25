@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <form class="form-horizontal" role="form" method="GET" action="{{ url('/community/search') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="keyword" class="col-md-3 control-label">iSport</label>
                                <div class="col-md-6">
                                    <input id="keyword" type="text" class="form-control" name="keyword" value="{{ $keyword }}" required autofocus>
                                </div>
                                <button class="btn btn-default" type="submit">search</button>
                            </div>
                        </form>
                    </div>
                    <div class="panel-body">
                        @foreach($users as $user)
                            <div class="col-md-offset-1 col-md-3 card">
                                <h5><a href="{{ url('/account/info?name='.$user->name).'&keyword='.$_GET['keyword'] }}">{{$user->name}}</a></h5>
                                    <ul>
                                    @foreach(explode(',', $user->preference) as $preference)
                                        <li>
                                            {{$preference}}
                                        </li>
                                    @endforeach
                                </ul>
                                <a class="follow" href="{{ url('/community/follow?name='.$user->name).'&keyword='.$_GET['keyword']}}">Follow</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
