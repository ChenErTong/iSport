@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="preference[]" class="col-md-4 control-label">Preference</label>

                            <div class="col-md-6">

                                <div class="checkbox">
                                    <label><input type="checkbox" name="preference[0]" value="Run">Run</label>
                                    <label><input type="checkbox" name="preference[1]" value="Swimming">Swimming</label>
                                    <label><input type="checkbox" name="preference[2]" value="Basketball">Basketball</label>
                                    <label><input type="checkbox" name="preference[3]" value="Volleyball">Volleyball</label>
                                    <label><input type="checkbox" name="preference[4]" value="Soccer">Soccer</label>
                                    <label><input type="checkbox" name="preference[5]" value="PingPong">PingPong</label>
                                    <label><input type="checkbox" name="preference[6]" value="Badminton">Badminton</label>
                                    <label><input type="checkbox" name="preference[7]" value="Fitness">Fitness</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('image-input') ? ' has-error' : '' }}">
                            <label for="image-input" class="col-md-4 control-label">Avatar</label>

                            <div class="col-md-6">
                                <a href=";" class="file">Select Image<input id="image-input" type="file" name="image-input" accept="image/*"></a>
                                <div id="image-holder"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
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
