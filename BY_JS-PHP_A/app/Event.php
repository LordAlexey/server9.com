<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $guarded = [];
    public $timestamps = false;

    public function attendees()
    {
        return $this->belongsToMany('App\Attendee','event_attendee')->withPivot([
            'registration_type',
            'registration_date',
            'calculated_price',
            'event_rating',
            'id'
        ]);
    }


    public function sessions()
    {
        return $this->hasMany('App\Session');
    }

    public function addSession($data)
    {
        foreach ($data as $session){
            $this->sessions()->create([
                'title'=>$session['title'],
                'room'=>$session['room'],
                'speaker'=>$session['speaker'],
            ]);
        }
    }

    public function addAttendee($id,$type)
    {
        $price=$this->standard_price;

        if($type=='early_bird') $price*=0.85;
        if($type=='vip') $price*=1.2;


        $this->attendees()->attach($id,[
            'registration_type'=>$type,
            'registration_date'=>date('Y-m-d H:i:s',time()),
            'calculated_price'=>$price
        ]);
    }


}
