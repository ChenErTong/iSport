@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        COMMUNITY ACTIVITIES
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <th style="padding-left: 15%">Name</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Vacancy</th>
                            </thead>
                            <tbody>
                            @foreach ($activities as $activity)
                                <tr>
                                    <td class="links"><a href="{{'/activity?id='.$activity->id}}">{{ $activity->name }}</a></td>
                                    <td>{{ $activity->location }}</td>
                                    <td>{{ date('m/d/y h:i', strtotime($activity->date)) }}</td>
                                    <td>{{ $activity->room }} / {{ $activity->remain }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection