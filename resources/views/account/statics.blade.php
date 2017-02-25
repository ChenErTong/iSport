@extends('layouts.app')

<script src="{{ asset('/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('/js/echarts.common.min.js') }}"></script>
<script src="{{ asset('/js/iSport.js') }}"></script>

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Duration of Each Sport
                    </div>

                    <div class="panel-body">
                        <div id="person_duration" style="height:60%; color: white">
                            <script>
                                person_duration('<?php echo implode(';', $sports) ?>');
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <table class="table">
                            <thead>
                            <th>Sport</th>
                            <th>Duration</th>
                            <th>Date</th>
                            </thead>
                            <tbody>
                            @foreach ($records as $record)
                                <tr>
                                    <td>{{ $record->sport }}</td>
                                    <td>{{ $record->duration }} minutes</td>
                                    <td>{{ $record->started_at }}</td>
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