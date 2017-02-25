<?php

namespace App\Http\Controllers;

use App\Activity;
use App\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Auth;
use Redirect;

class ActivityController extends Controller
{
    protected $redirectTo = '/activity/account';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function account()
    {
        $activities = UserActivity::where('user', Auth::user()->name)->join('activities', 'user_activities.activity', '=', 'activities.id')->orderBy('date', 'desc')->get();

        return view('activity.account', ['activities' => $activities]);
    }

    public function info()
    {
        $activity_id = Input::get('id');
        $activity = Activity::where('id', $activity_id)->get();
        $relation = UserActivity::where('activity', $activity_id)->where('user', Auth::user()->name)->get();
        if (count($relation) === 0)
            $relation = 'not participated';
        else
            $relation = $relation[0]->relation;
        return view('activity.info', ['activity' => $activity[0], 'relation'=>$relation]);
    }

    public function community()
    {
        $activities = Activity::orderBy('date', 'desc')->get();
        return view('activity.community', ['activities' => $activities]);
    }

    public function creation()
    {
        return view('activity.create');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:activities',
            'location' => 'required|max:255',
            'date' => 'required|date|after:today',
            'info' => 'required',
            'room' => 'required|min:1',
        ]);
    }

    protected function createActivity(array $data)
    {
        if(isset($data['image'])){
            return Activity::create([
                'name' => $data['name'],
                'location' => $data['location'],
                'date' => $data['date'],
                'info' => $data['info'],
                'image' => $data['image'],
                'room' => $data['room'],
                'remain' => $data['room'],
                'host' => Auth::user()->name,
            ]);
        }else{
            return Activity::create([
                'name' => $data['name'],
                'location' => $data['location'],
                'date' => $data['date'],
                'info' => $data['info'],
                'room' => $data['room'],
                'remain' => $data['room'],
                'host' => Auth::user()->name,
            ]);
        }
    }

    protected function createRelation(array $date)
    {
        return UserActivity::create([
            'activity' => $date['id'],
            'user' => $date['user'],
            'relation' => $date['relation'],
        ]);
    }

    public function confirmCreation(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()){
            return Redirect::to('/activity/create')
                ->withErrors($validator)
                ->withInput();
        }else{
            $data = $request->all();
            if($request->hasFile('image-input')){
                $data['image'] = $request->file('image-input')->store('images');
            }
            $activity = $this->createActivity($data);
            $attributes = $activity->getAttributes();
            $attributes['relation'] = 'own';
            $attributes['user'] = Auth::user()->name;
            $this->createRelation($attributes);
            return Redirect::to('/activity/account');
    }
    }

    public function join()
    {
        $activity_id = Input::get('id');
        Activity::where('id', $activity_id)->decrement('remain');
        $attributes['id'] = $activity_id;
        $attributes['relation'] = 'apply';
        $attributes['user'] = Auth::user()->name;
        $this->createRelation($attributes);
        return Redirect::to('/activity/account');
    }

    public function cancel(Request $request)
    {
        $id = $request->all()['id'];
        UserActivity::where('activity', $id)->delete();
        Activity::destroy($id);
        return Redirect::to('/activity/account');
    }

    public function background()
    {
        $path = storage_path('app').'/'.Input::get('path');
        $file = \File::get($path);
        $type = \File::mimeType($path);
        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
}
