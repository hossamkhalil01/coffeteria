<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Requests\ImageUploadRequest;

class admincontroller extends Controller
{
    //
    //
    public function GetAllUsers()
    {
        $users = User::where('is_admin', '=', 0)->with('room')->get();
        return response()->json($users);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json('user deleted');
    }

    public function showuser($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);

        $input = $request->all();
        if ($image = $request->file('avatar')) {
            $destinationPath = 'storage/avatars/';
            $profileImage = 'storage/avatars/'.$request->file('avatar')->getClientOriginalName(); 
            $image->move($destinationPath, $profileImage);
            $input['avatar'] = "$profileImage";
        }
        $update = $user->update($input);   
        
        if ($update){
            return response()->json(["succes"=>$input]);
        }else{
            return response()->json(["error"=>$input]);

        }   
      
      
    }

    public function store(Request $request)
    {


        $input = $request->all();
  
        if ($image = $request->file('avatar')) {
            $destinationPath = 'storage/avatars/';
            $profileImage = 'storage/avatars/'.$request->file('avatar')->getClientOriginalName(); 
            $image->move($destinationPath, $profileImage);
            $input['avatar'] = "$profileImage";
        }

        $add = User::create($input);
        dd($add);
        if ($add){
            return response()->json(["is_done"=>true]);
        }else{
            return response()->json(["is_done"=>false]);
            


            }
    
    }}
