@extends('layouts.app')

@section('content')
    <div class="container">
    <h1>Import attendees</h1>
        @include('messages')
        <h3>Event name: {{$event->title}}</h3>
        <form action="{{route('import',$event->id)}}" method="post" enctype="multipart/form-data">
            @csrf
        <label for="">
            CSV file: <input type="file" name="csv">
        </label>

            <input type="submit" value="Import">
            <input type="reset" value="Cancel">
        </form>
    </div>
@endsection
