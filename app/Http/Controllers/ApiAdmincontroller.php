<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ApiAdmincontroller extends Controller
{
    //
    public function GetAllUsers(){
        $users=User::all();
        return response()->json($users);


    }
}
