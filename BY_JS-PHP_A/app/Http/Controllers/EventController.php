<?php

namespace App\Http\Controllers;

use App\Attendee;
use App\Http\Requests\EventRequest;
use Illuminate\Http\Request;
use App\Event;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $events=Event::all();
        return view('events',['title'=>'Events','events'=>$events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('create',['title'=>'Create event']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        //
        $sessions = $request->sessions;
        $event = Event::create($request->except('sessions','_token'));
        $event->addSession($sessions);

        return back()->with('message','Event successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
        return view('edit',['title'=>'Edit event','event'=>$event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
        $event->update($request->all());
        return back()->with('message','Event successfully saved');
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


    public function detail(Event $event)
    {
        return view('detail',['title'=>'Event details','event'=>$event]);
    }

    public function attList(Event $event)
    {
        return view('list',['title'=>'Attendee list','event'=>$event]);
    }

    public function export(Event $event)
    {
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=file.csv');

        $fp = fopen('php://output','w');
        $attendees = $event->attendees;


        foreach ($attendees as $attendee) {

            $date = date('Y/m/d H:i:s',strtotime($attendee->pivot->registration_date));

            fputcsv($fp, [
                'email'=>$attendee->email,
                'firstname'=>$attendee->firstname,
                'lastname'=>$attendee->lastname,
                'gender'=>$attendee->gender,
                'age'=>$attendee->age,
                'registration_type'=>$attendee->pivot->registration_type,
                'registration_date'=>$date,
            ],';');
        }

        fclose($fp);
    }

    public function import(Event $event)
    {
        return view('import',['title'=>'Import event','event'=>$event]);
    }

    public function importSave(Request $request,Event $event)
    {
        $count =0;
        $path = $request->file('csv')->getPathname();
        $fp = fopen($path,'r');

        while(($data=fgetcsv($fp,1000,';'))!==false){

            $count++;
            $attendee = Attendee::create([
                'email'=>$data[0],
                'username'=>$data[1],
                'firstname'=>$data[1],
                'lastname'=>$data[2],
                'gender'=>$data[3],
                'age'=>$data[4],
                'password-hash'=>md5('attendee1pass')
            ]);

            $price=$event->standard_price;

            if($data[5]=='early_bird') $price*=0.85;
            if($data[5]=='vip') $price*=1.2;

            $date = date('Y-m-d H:i:s',strtotime($data[6]));


            DB::table('event_attendee')->insert([
                'event_id'=>$event->id,
                'attendee_id'=>$attendee->id,
                'registration_type'=>$data[5],
                'registration_date'=>$date,
                'calculated_price'=>$price,
            ]);

        }


        return back()->with('message','Imported '.$count.' attendees');
    }

    public function reports(Event $event)
    {
        $ratings = $event->attendees()->where('event_rating','!=',null)->get();
        return view('reports',['title'=>'Event reports','event'=>$event,'ratings'=>$ratings]);
    }

    public function diagrams(Event $event)
    {
        $ratings = $event->attendees()->where('event_rating','!=',null)->get();

        $response = [];
        $response['pie'][0] = $ratings->where('pivot.event_rating',0)->count();
        $response['pie'][1] = $ratings->where('pivot.event_rating',1)->count();
        $response['pie'][2] = $ratings->where('pivot.event_rating',2)->count();

        $registrations = DB::table('event_attendee')
            ->groupBy('date')
            ->select(DB::raw('DATE(registration_date) as date'),DB::raw('count(id) as count'))
            ->get();

        $response['bars'] = $registrations;


        return response()->json($response,200);
    }

}
