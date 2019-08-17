<?php

namespace App\Http\Controllers\Api;

use App\Attendee;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Event;

class UserController extends Controller
{
    //

    public function create(Request $request)
    {

        try {
            if(Attendee::where('email',$request->email)->count()) {
                return response()->json(['message'=>'User email already registered'],422);
            }
            if(Attendee::where('username',$request->username)->count()) {
                return response()->json(['message'=>'Username already registered'],422);
            }


            $valitation = Validator::make($request->all(),[
                'firstname'=>'required|max:255',
                'lastname'=>'required|max:255',
                'username'=>'required|max:255',
                'password'=>'required',
                'email'=>'required|max:255|email',
                'linkedin_url'=>'nullable|url|max:255',
                'gender'=>'in:male,female',
                'age'=>'required|max:130|min:5|integer'
            ]);

            if($valitation->fails()) {
                return response()->json(['errors'=>$valitation->errors()],422);
            }

            $rec = $request;

            $password = md5($request->password);
            $gender = $request->gender;
            $gender?true:$gender='X';

            $data = $request->except('_token','password','gender');
            $data['password-hash'] = $password;
            $data['gender'] = $gender;


            Attendee::create($data);
            ///
//            dump($rec);
            return $this->login($request);


        }
        catch(\Exception $exception) {
            return response()->json(['message'=>'Data can not be processed'],422);
        }

    }

    public function login(Request $request)
    {
        $attendee = Attendee::where('username',$request->username)->where('password-hash',md5($request->password))->first();
        if($attendee) {
            $token = md5($request->username);
            $attendee->api_token = $token;
            $attendee->save();
            return response()->json(['token'=>$token],200);
        }
        else {
            return response()->json(['message'=>'Invalid login'],401);
        }


    }

    public function logout(Request $request)
    {
        $request->user->api_token = '';
        $request->user->save();
        return  response()->json(['message'=>'Logout success'],200);
    }

    public function events(Request $request)
    {
        $events = $request->user->events()->get();
        $array = [];
        foreach ($events as $event) {

            $res = $event->pivot;

            $uid = $event->pivot->attendee_id;

            unset($res['attendee_id']);
            $res['user_id'] = $uid;
//            $res['id'] = $event->i;

            $array[] = $res;
        }

        return response()->json($array,200);
    }

    public function rate(Request $request,$id)
    {
        $event = Event::find($id);

        $val = Validator::make(['id'=>$id],[
            'id'=>'required|integer'
        ]);
        if($val->fails()) {
            return response()->json(['errors'=>$val->errors()],401);
        }


        if($event) {
            if(!$event->attendees()->where('attendee_id',$request->user->id)->first())
                return response()->json(['message'=>'User not registered for this event'],401);
            $user = $event->attendees()->where('attendee_id',$request->user->id)->first()->pivot;
            $user->event_rating = $request->event_rating;
            $user->save();

            return response()->json(['message'=>'Rating success'],200);
        }
        return response()->json(['message'=>'Not found'],401);

    }

}
