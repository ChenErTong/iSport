@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create A New Activity</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/activity/create/confirm') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                                <label for="location" class="col-md-4 control-label">Location</label>

                                <div class="col-md-6">
                                    <input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}" required>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                <label for="date" class="col-md-4 control-label">Date</label>

                                <div class="col-md-6">
                                    <input id="date" type="datetime-local" class="form-control" name="date" value="{{ old('date') }}" required>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('room') ? ' has-error' : '' }}">
                                <label for="room" class="col-md-4 control-label">Number of Participants</label>

                                <div class="col-md-6">
                                    <input id="room" type="number" class="form-control" name="room" value="10" required>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('info') ? ' has-error' : '' }}">
                                <label for="info" class="col-md-4 control-label">Information</label>

                                <div class="col-md-6">
                                    <textarea id="info" type="text" class="form-control" name="info" value="{{ old('info') }}" required></textarea>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('image-input') ? ' has-error' : '' }}">
                                <label for="image-input" class="col-md-4 control-label">Image <i>(Optional)</i></label>

                                <div class="col-md-6">
                                    <a href=";" class="file">Select Image<input id="image-input" type="file" name="image-input" accept="image/*"></a>
                                    <div id="image-holder"></div>
                                </div>
                            </div>

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">
                                        Confirm
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/jquery-3.1.1.min.js') }}"></script>
    <script>
        $("#image-input").on('change', function () {
            if(typeof (FileReader) != "undefined"){
                var image_holder = $("#image-holder");
                image_holder.empty();

                var reader = new FileReader();
                reader.onload = function (e) {
                    $("<img />", {
                        "id": "image",
                        "name": "image",
                        "src": e.target.result,
                        "class": "cover_small"
                    }).appendTo(image_holder);
                };
                image_holder.show();

                reader.readAsDataURL($(this)[0].files[0]);
            }
        })
    </script>
@endsection