<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Requests\ImageUploadRequest;

class admincontroller extends Controller
{
    //
    //
    public function GetAllUsers()
    {
        $users = User::where('is_admin', '=', 0)->with('room')->paginate(3);
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
        $request->validate([
            'name' => ['required'], 
            
            'room_id' => ['required']
        ]);
        if ($image = $request->file('avatar')) {
            $destinationPath = 'storage/images/avatars/' . $user->id;
            $profileImage = $request->file('avatar')->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $input['avatar'] = $user->id . "/" . $profileImage;
        }
        $user->update($input);   
        
        if ($user){
            return response()->json(["error"=>$input]);
        }else{
            return response()->json(["error"=>$input]);

        }
    }

    public function store(Request $request)
    {


        $input = $request->all();
        $request->validate([
            'name' => ['required'], 
            'email' => ['required', 'email', 'unique:users'],
            'password'=>['required', 'min:8'],
            'confirm_password'=>'required|same:password',
            // 'avatar' => ['required'],
            'room_id' => ['required']
        ]);
        $input['password']=Hash::make($input['password']);
        $user = User::create($input);

        if ($image = $request->file('avatar')) {
            $destinationPath = 'storage/images/avatars/' . $user->id;
            $profileImage = $request->file('avatar')->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $user->avatar = $user->id . "/" . $profileImage;
            $user->save();
        }

        // return response()->json(["message" => "user Created"]);
     
       
    }}
