<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;


class roomcontroller extends Controller



{
    //
    public function index(){
        $rooms=Room::all();
        return response()->json($rooms);


    }

    
}
