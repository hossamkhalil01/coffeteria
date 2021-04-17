<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ApiAdmincontroller extends Controller
{
    //
    public function GetAllUsers(){
        $users=User::all()->toArray();
        return array($users);


    }
}
