@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="header">
            <h1>Attendee list</h1>
            <h2>{{$event->title}}</h2>
            <table>
                <tr>
                    <td>Firstname</td>
                    <td>Lastname</td>
                    <td>Email</td>
                    <td>Photo</td>
                </tr>

                @foreach($event->attendees as $attendee)
                    <tr>
                        <td>{{$attendee->firstname}}</td>
                        <td>{{$attendee->lastname}}</td>
                        <td>{{$attendee->email}}</td>
                        <td><img src="{{$attendee->photo}}" width="100" alt=""></td>
                    </tr>
                    @endforeach

            </table>
        </div>

    </div>
@endsection
