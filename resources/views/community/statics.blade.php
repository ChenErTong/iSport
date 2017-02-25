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
                        Ratio of Each Sport
                    </div>

                    <div class="panel-body">
                        <div id="community_ratio" style="height:60%; color: white">
                            <script>
                                community_ratio('<?php echo $ratio ?>');
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @foreach (explode(',', Auth::user()->preference) as $interest)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Rank of {{$interest}}
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead style="text-align: center">
                            <th>User</th>
                            <th>Duration</th>
                            </thead>
                            <tbody>
                            @foreach ($sports[$interest] as $rank)
                                <tr>
                                    <td>{{ $rank->host }}</td>
                                    <td>{{ $rank->duration }} minutes</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection