@if(session('message'))
    <div class="alert alert-success">
        <b>{{session('message')}}</b>
    </div>
    @endif

@if($errors->count())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif