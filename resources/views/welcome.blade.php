@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-top: 10%">
        <div class="col-md-6 col-md-offset-3" style="text-align: center">
            <div class="title m-b-md">
                iSport
            </div>

            <div class="links">
                @if (Auth::guest())
                    <h3 style="color: #ab8949">Make Sport Simple</h3>
                @else
                    <a style="color: #ab8949" href="{{ url('/statics/account') }}">Statics</a>
                    <a style="color: #ab8949" href="{{ url('/activity/account') }}">Activity</a>
                    <a style="color: #ab8949" href="{{ url('/community/moment') }}">Community</a>
                    <a style="color: #ab8949" href="{{ url('/account/info?name='.Auth::user()->name) }}">Account</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection