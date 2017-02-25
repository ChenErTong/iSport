@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        MY ACTIVITIES
                        <a class="btn btn-default" style="margin-left: 60%" href="{{url('/activity/create')}}">Create Activity</a>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Date</th>
                                <th>Vacancy</th>
                                <th>State</th>
                            </thead>
                            <tbody>
                            @foreach ($activities as $activity)
                                <tr>
                                    <td class="links"><a href="{{'/activity?id='.$activity->id}}">{{ $activity->name }}</a></td>
                                    <td>{{ $activity->location }}</td>
                                    <td>{{ date('m/d/y h:i', strtotime($activity->date)) }}</td>
                                    <td>{{ $activity->room }} / {{ $activity->remain }}</td>
                                    <td>{{ $activity->relation }} </td>
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