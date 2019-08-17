<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
 protected $guarded = [];
    //

    public function events()
    {
        return $this->belongsToMany('App\Event','event_attendee')->withPivot([
           'registration_type',
           'registration_date',
           'calculated_price',
           'event_rating',
                'id'
            ]
        );



    }

}
