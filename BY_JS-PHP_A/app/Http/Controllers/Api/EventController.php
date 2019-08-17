<?php

namespace App\Http\Controllers\Api;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    //
    public function all()
    {
        $events = Event::with('sessions')->get();
        return response()->json($events,200);
    }

    public function register(Request $request)
    {
        $event = Event::where('id',$request->event_id)->first();

        $val = Validator::make($request->all(),[
           'event_id'=>'required|integer'
        ]);
        if($val->fails()) {
            return response()->json(['errors'=>$val->errors()],401);
        }

        if(!$event)
            return response()->json(['message'=>'Not found'],401);

        if(!$event->attendees()->where('attendee_id',$request->user->id)->count())
        $event->addAttendee($request->user->id,$request->registration_type);

        return response()->json(['message'=>'Registration success'],200);
    }

}
