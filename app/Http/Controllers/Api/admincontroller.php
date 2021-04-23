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
            $destinationPath = 'storage/images/avatars/'.$user->id;
            $profileImage = $request->file('avatar')->getClientOriginalName(); 
            $image->move($destinationPath, $profileImage);
            $input['avatar']= $destinationPath."/".$profileImage;
            // $add->save();

        }
        $user->update($input);   
        
        if ($user){
            return response()->json(["succes"=>$input]);
        }else{
            return response()->json(["error"=>$input]);

        }   
      
      
    }

    public function store(Request $request)
    {


        $input = $request->all();
        $user = User::create($input);

         if ($image = $request->file('avatar')) {
             env(APP_URL);
            $destinationPath = 'storage/images/avatars/'.$user->id;
            $profileImage = $request->file('avatar')->getClientOriginalName(); 
            $image->move($destinationPath, $profileImage);
            $user->avatar = $destinationPath."/".$profileImage;
            $user->save();

        }
        // dd($user);
        if ($user){
            return response()->json(["is_done"=>true]);
        }else{
            return response()->json(["is_done"=>false]);
            


            }
    
    }}
