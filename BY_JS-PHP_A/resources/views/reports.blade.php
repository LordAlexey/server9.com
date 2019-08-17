@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Event rating</h1>
        <h2>{{$event->title}}</h2>
    Total ratings: {{$ratings->count()}}

        <canvas id="circle"></canvas>

        <h2>Registration trends</h2>

        <canvas id="bars"></canvas>

        <h2>Line graf</h2>
        <canvas id="line"></canvas>

        <h2>Mixed</h2>
        <canvas id="mixed"></canvas>
        <h2>Scatter</h2>
        <canvas id="scatter"></canvas>
    </div>
@endsection
