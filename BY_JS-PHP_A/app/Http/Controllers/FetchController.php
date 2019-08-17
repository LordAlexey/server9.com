<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FetchController extends Controller
{
    //


    public function upload(Request $request)
    {
//        dump($request->all());
        $request->file('file')->store('images/');
        return response()->json(['message'=>'Success upload'],200);
    }

    public function download()
    {
        return Storage::download('images/image.png');
    }
}
