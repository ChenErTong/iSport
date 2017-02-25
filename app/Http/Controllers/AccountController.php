<?php

namespace App\Http\Controllers;

use App\Follow;
use App\Record;
use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function info()
    {
        $user = User::where('name', Input::get('name'))->first();
        $followings = Follow::select(\DB::raw('count(*) as counts'))->where('follower', Input::get('name'))->first();
        $followers = Follow::select(\DB::raw('count(*) as counts'))->where('following', Input::get('name'))->first();
        $durations = Record::select(\DB::raw('sport, sum(duration) as duration, max(started_at) as last'))->where('host', Input::get('name'))->groupBy('sport')->get();
        return view('account.info', ['user'=>$user, 'following'=>$followings->counts, 'follower'=>$followers->counts, 'durations'=>$durations]);
    }

    public function avatar()
    {
        $path = storage_path('app').'/'.Input::get('path');
        $file = \File::get($path);
        $type = \File::mimeType($path);
        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    public function follow()
    {
        $followings = Follow::select('following')->where('follower', Auth::user()->name)->get();
        $followers = Follow::select('follower')->where('following', Auth::user()->name)->get();
        return view('account.follow', ['followers'=>$followers, 'followings'=>$followings]);
    }

    public function statics()
    {
        $records = Record::where('host', Auth::user()->name)->orderBy('started_at', 'desc')->get();
        $durations = Record::select(\DB::raw('sport, sum(duration) as duration'))->where('host', Auth::user()->name)->groupBy('sport')->orderBy('duration', 'desc')->get();
        $sports = array();
        foreach (explode(',', Auth::user()->preference) as $sport){
            $sports[$sport] = Record::where('host', Auth::user()->name)->where('sport', $sport)->orderBy('started_at', 'desc')->get();
        }
        return view('account.statics', ['records'=>$records, 'durations'=>$durations, 'sports'=>$sports]);
    }
}
