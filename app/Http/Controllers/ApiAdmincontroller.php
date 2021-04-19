<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ApiAdmincontroller extends Controller
{
    //
    public function GetAllUsers(){
        $users=User::where('is_admin','=',0)->get();
        return response()->json($users);


    }

    public function destroy($id){
        $user=User::find($id);
        $user->delete();
        return response()->json('user deleted');
    }

    public function showuser($id){
        $user=User::find($id);
        return response()->json($user);
    }

    public function update($id,Request $req){
        $user=User::find($id);
        $user->update($req->all());

        return response()->json('user updated');
    }
}
