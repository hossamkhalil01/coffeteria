<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class admincontroller extends Controller
{
    //
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
        $url ="";
        $user=User::find($id);
        $user->name=$req->name;
        $user->email=$req->email;
        $user->room_id=$req->room_id;
        // $user->avatar=$req->file('image');
        

        // $fileUpload = new FileUpload;
    
        if($req->image)
       {
        $file = $request->file('image');
        // $name = Str::random(10);
        $url = \Storage::putFileAs('avatars', $file, $name.'.'.$file->extension());
        // $name = time().'.' . explode('/', explode(':', substr($request->avatar, 0, strpos($request->avatar, ';')))[1])[1];
        // \Image::make($req->image)->save(public_path('avatar/').$name);
        // $req->merge(['avatar' => $name]);
        }
        $user->avatar=$url;
        $user->save();

        // $req->file('image')->store("avatars");
        // $user->update($req->all());

        return response()->json('user updated');
    }

    public function create(){
        
    }
}
