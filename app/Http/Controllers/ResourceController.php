<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Activity::all();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postUrl = url('/activity/create/confirm');
        $csrf_field = csrf_field();
        $html = <<<CREATE
        <form class="form-horizontal" role="form" method="POST" action="$postUrl">
           $csrf_field

            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Name</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="location" class="col-md-4 control-label">Location</label>

                <div class="col-md-6">
                    <input id="location" type="text" class="form-control" name="location" required>
                </div>
            </div>

            <div class="form-group">
                <label for="date" class="col-md-4 control-label">Date</label>

                <div class="col-md-6">
                    <input id="date" type="datetime-local" class="form-control" name="date" required>
                </div>
            </div>

            <div class="form-group">
                <label for="room" class="col-md-4 control-label">Number of Participants</label>

                <div class="col-md-6">
                    <input id="room" type="number" class="form-control" name="room" required>
                </div>
            </div>

            <div class="form-group">
                <label for="info" class="col-md-4 control-label">Information</label>

                <div class="col-md-6">
                    <textarea id="info" type="text" class="form-control" name="info" required></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Confirm
                    </button>
                </div>
            </div>
        </form>
CREATE;
         return $html;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Activity::create([
            'name' => $data['name'],
            'location' => $data['location'],
            'date' => $data['date'],
            'info' => $data['info'],
            'room' => $data['room'],
            'remain' => $data['room'],
            'host' => Auth::user()->name,
        ]);
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Activity::where('id', $id)->first();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
