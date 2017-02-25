@extends('layouts.app')
@if(isset($activity->image))
<script src="{{ asset('/js/jquery-3.1.1.min.js') }}"></script>
<script>
    $(document).ready(function () {
        document.getElementById('app').style.backgroundImage = "url('{{ url('/activity/background?path='.$activity->image) }}')";
        document.getElementById('app').className = "app-background";
    })
</script>
@endif
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$activity->name}}
                        @if($activity->host === Auth::user()->name)
                            <button class="btn btn-danger" style="margin-left: 40%" onclick="event.preventDefault(); document.getElementById('cancel-form').submit();">Cancel Activity</button>
                            <form id="cancel-form" action="{{ url('/activity/cancel') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                <input name="id" value="{{$activity->id}}">
                            </form>
                        @endif
                    </div>

                    <div class="panel-body">
                        <ul>
                            <li><strong>Location:</strong> {{$activity->location}}</li>
                            <li><strong>Date:</strong> {{ date('m/d/y h:i', strtotime($activity->date)) }}</li>
                            <li><strong>Host:</strong> {{$activity->host}}</li>
                            <li><strong>Total Number:</strong> {{$activity->room}}</li>
                            <li><strong>Participated Number:</strong> {{$activity->room - $activity->remain}}</li>
                            <li><strong>Remain Number:</strong> {{$activity->remain}}</li>
                            <li><strong>Your State:</strong> {{$relation}}</li>
                            <li><strong>Information:</strong><br> {{$activity->info}}</li>
                        </ul>
                        <div style="float: right">
                            @if($relation === 'not participated')
                                @if($activity->remain > 0)
                                    <button class="btn btn-info" onclick="event.preventDefault();
                                                     document.getElementById('join-form').submit();">Participate</button>
                                    <form id="join-form" action="{{ url('/activity/join?id='.$activity->id) }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                @else
                                    <button class="btn btn-danger" disabled>No Vacancy</button>
                                @endif
                            @endif

                            <button class="btn btn-success" onclick="history.back(-1);">Return</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection