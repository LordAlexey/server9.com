@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="header">
            Events
            <a id="add-event" href="{{route('create')}}">Add event</a>
        </div>

        <div class="content">
            <table>
                <thead>
                <tr>
                    <th>Event</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($events as $event)
                <tr class="event">
                    <td class="event-title">
                        <a href="{{route('detail',$event->id)}}">{{$event->title}}</a>
                    </td>
                    <td class="event-date">{{$event->date}}</td>
                    <td class="event-price">{{$event->standard_price}}.-</td>
                    <td class="event-actions">
                        <a class="event-participants" href="{{route('list',$event->id)}}">Attendee list</a>
                        <a href="{{route('export',$event->id)}}">Export attendees</a>
                        <a href="{{route('import',$event->id)}}">Import attendees</a>
                        <a class="event-ratings" href="{{route('reports',$event->id)}}">Rating diagram</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
