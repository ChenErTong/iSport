<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Follow;
use App\Moment;
use App\Record;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Auth;

class CommunityController extends Controller
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

    public function  search()
    {
        $users = array();
        $keyword = '';
        if (Input::has('keyword')){
            $keyword = Input::get('keyword');
            $users = User::whereRaw('upper("name") like "%'.strtoupper($keyword).'%" and "name" <> "'.Auth::user()->name.'" and "name" not in (select "following" from "follows" where "follower" = "'.Auth::user()->name.'")') ->get();
        }
        return view('community.search', ['users'=>$users, 'keyword'=>$keyword]);
    }

    public function  moment()
    {
        $moments = Moment::whereIn('host', function ($q){
            $q->select('following')
                ->from('follows')
                ->where('follower', Auth::user()->name);
            })->orWhere('host', Auth::user()->name)
            ->orderBy('created_at', 'desc')->get();
        for ($i=0; $i<count($moments); $i++){
            $moments[$i]['comments'] = Comment::where('moment', $moments[$i]->id)->orderBy('created_at')->get();
        }
        return view('community.moment', ['moments'=>$moments]);
    }

    public function follow(){
        Follow::create([
            'follower'=>Auth::user()->name,
            'following'=>Input::get('name'),
        ]);
        return $this->search();
    }

    protected function validatorForMoment(array $data)
    {
        return Validator::make($data, [
            'moment' => 'required|max:255',
        ]);
    }

    protected function validatorForComment(array $data)
    {
        return Validator::make($data, [
            'comment' => 'required|max:255',
        ]);
    }

    public function  release(Request $request)
    {
        $validator = $this->validatorForMoment($request->all());
        if ($validator->fails()){
            return Redirect::to('/community/moment')
                ->withErrors($validator)
                ->withInput();
        }else{
            Moment::create([
                'content'=>$request->get('moment'),
                'host'=>Auth::user()->name,
            ]);
            return Redirect::to('/community/moment');
        }
    }

    public function comment(Request $request)
    {
        $validator = $this->validatorForComment($request->all());
        if ($validator->fails()){
            return Redirect::to('/community/moment')
                ->withErrors($validator)
                ->withInput();
        }else{
            Comment::create([
                'moment'=>$request->get('id'),
                'content'=>$request->get('comment'),
                'host'=>Auth::user()->name,
            ]);
            return Redirect::to('/community/moment');
        }
    }

    public function statics()
    {
        $sports = array();
        foreach (explode(',', Auth::user()->preference) as $sport){
            $sports[$sport] = Record::select(\DB::raw('host, sum(duration) as duration'))->where('sport', $sport)->groupBy('host')->orderBy('duration', 'desc')->take(5)->get();
        }
        $ratio = Record::select(\DB::raw('sport, count(distinct(host)) as counts'))->groupBy('sport')->get();
        return view('community.statics', ['sports'=>$sports, 'ratio'=>$ratio]);
    }
}
