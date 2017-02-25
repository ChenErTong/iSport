@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center">
                        FOLLOWING: {{count($followings)}}
                    </div>
                    <div class="panel-body">
                        <ul>
                            @foreach($followings as $following)
                                <li><a href=" {{ url('/account/info?name='.$following->following) }} ">{{$following->following}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center">
                        FOLLOWER: {{count($followers)}}
                    </div>
                    <div class="panel-body">
                        <ul>
                            @foreach($followers as $follower)
                                <li><a href=" {{ url('/account/info?name='.$follower->follower) }} ">{{$follower->follower}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection