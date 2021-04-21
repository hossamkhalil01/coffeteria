<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class admincontroller extends Controller
{
    //
    //
    public function GetAllUsers()
    {
        $users = User::where('is_admin', '=', 0)->get();
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

    public function update($id, Request $req)
    {
        $url = "";
        $user = User::find($id);
        $user->name = $req->name;
        $user->email = $req->email;
        $user->room_id = $req->room_id;
        // $user->avatar=$req->file('image');


        // $fileUpload = new FileUpload;
        // if ($req->hasFile('avatar')) {

        //     $avatar = $req->file('avatar')->getClientOriginalName();
        //     $avatar_path =  $user->id . '/' . $avatar;

        //     //save the avatar
        //     $req->file('avatar')->storeAs('avatars', $avatar_path, '');

        //     // update the path
        //     $user->update(['avatar' => 'storage/avatars/' . $avatar_path]);
        // }

        //     if($req->image)
        //    {
        //     $file = $request->file('image');
        //     // $name = Str::random(10);
        //     $url = \Storage::putFileAs('avatars', $file, $name.'.'.$file->extension());
        //     // $name = time().'.' . explode('/', explode(':', substr($request->avatar, 0, strpos($request->avatar, ';')))[1])[1];
        //     // \Image::make($req->image)->save(public_path('avatar/').$name);
        //     // $req->merge(['avatar' => $name]);
        //     }
        // $user->avatar=$url;
        $user->save();

        // $req->file('image')->store("avatars");
        // $user->update($req->all());

        return response()->json('user updated');
    }

    public function store(Request $req)
    {
        // $user = User::create([
        //     'name' => $req->input('name'),
        //     'email' => $req->input('email'),
        //     'password' => Hash::make($req->input('password')),
        //     'room_id' => $req->input('room_id'),
        //     'avatar' => 'storage/avatars/default.png',
        // ]);

        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;

        $user->password = $req->password;
        // $user->room_id=$req->room_id;
        $user->avatar = 'storage/avatars/default.png';

        // if ($req->file('avatar')) {

        //     $avatar = $req->file('avatar')->getClientOriginalName();
        //     $avatar_path =  $user->id . '/' . $avatar;

        //     //save the avatar
        //     $req->file('avatar')->storeAs('avatars', $avatar_path, '');

        //     // update the path
        //     $user->update(['avatar' => 'storage/avatars/' . $avatar_path]);
        // }
        $user->save();
        return response()->json('user created!');
        // return $user;

    }
}
