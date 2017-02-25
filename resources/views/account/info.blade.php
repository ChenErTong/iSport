@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$user->name}}
                        @if($user->name !== Auth::user()->name)
                            @if(isset($_GET['keyword']))
                                <a class="btn btn-default"style="margin-left: 61%" href="{{ url('/community/follow?name='.$user->name).'&keyword='.$_GET['keyword']}}">follow</a>
                                <a class="btn btn-default"style="margin-left: 1%" onclick="history.back(-1);">return</a>
                            @else
                                <a class="btn btn-default"style="margin-left: 82%" onclick="history.back(-1);">return</a>
                            @endif
                        @endif
                    </div>

                    @if(isset($user->image))
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
                                <img id="avatar" src="{{url('/account/avatar?path='.$user->image)}}" class="cover_small">
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="email" class="col-md-2 control-label">Email</label>

                            <div class="col-md-10">
                                {{ $user->email }}
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label for="address" class="col-md-2 control-label">Address</label>

                            <div class="col-md-10">
                                {{ $user->address }}
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Follower</label>

                            <div class="col-md-4">
                                {{ $follower }}
                            </div>

                            <label class="col-md-2 control-label">Following</label>

                            <div class="col-md-4">
                                {{ $following }}
                            </div>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <th>Sport</th>
                            <th>Duration</th>
                            <th>Last Date</th>
                        </thead>
                        <tbody>
                            @foreach($durations as $duration)
                                <tr>
                                    <td>{{ $duration->sport }}</td>
                                    <td>{{ $duration->duration }}</td>
                                    <td>{{ $duration->last }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection