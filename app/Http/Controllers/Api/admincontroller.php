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

    public function update($id, Request $request)
    {

        $input = $request->all();
        if ($image = $request->file('avatar')) {
            $destinationPath = 'storage/avatars/';
            $profileImage = 'storage/avatars/'.$request->file('avatar')->getClientOriginalName(); 
            $image->move($destinationPath, $profileImage);
            $input['avatar'] = "$profileImage";
        }
        $update = $product->update($input);   
        // $update = $product->update([
        //     'name' => $input['name'],
        //     'price' => $input['price'],
        //     'image' => $input['image'],
        //     'category_id' => $input['category_id']
        // ]);    
        if ($update){
            return response()->json(["succes"=>$input]);
        }else{
            return response()->json(["error"=>$input]);

        }   
        // $url = "";
        // $user = User::find($id);
        // $user->name = $req->name;
        // $user->email = $req->email;
        // $user->room_id = $req->room_id;
        // // $user->avatar=$req->file('image');
        // if ($image = $req->file('avatar')) {
        //     $destinationPath = 'storage/avatars/';
        //     $profileImage = 'storage/avatars/'.$req->file('avatar')->getClientOriginalName(); 
        //     $image->move($destinationPath, $profileImage);
        //     $user->avatar = "$profileImage";
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
        // $user->save();

        // $req->file('image')->store("avatars");
        // $user->update($req->all());

        // return response()->json('user updated');
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
        // $user = User::create([
        //     'name' => $req->input('name'),
        //     'email' => $req->input('email'),
        //     'password' => Hash::make($req->input('password')),
            
        //     'room_id' => $req->input('room_id'),
        //     'avatar' => $req->file('avatar'),
        // ]);
       
        // $user = new User();
        // $user->name = $req->name;
        // $user->email = $req->email;

        // $user->password = Hash::make($req->password);
        // $user->room_id=$req->room_id;
        // $user->avatar = $req->avatar;
        $name = "";
        // $this->validate($request,[
        //     'name' => 'required|string|max:191',
        // ]);

        // var_dump($request->image);

        // if ($request->avatar) {
            // $image = $request->file('avatar');
            // $destinationPath = 'storage/avatars/';
            //     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            //     $image->move($destinationPath, $profileImage);
            //     $request->avatar = "$profileImage";

                // $request->file('avatar')->store('avatar');
            // $name = time() . '.' . explode('/', explode(':', substr($request->avatar, 0, strpos($request->avatar, ';')))[1])[1];
            // $url = \Storage::putFileAs('avatars', $file, $name.'.'.$file->extension());
            // return ['url'=>env('APP_URL').'/'.$url];
            // $request->merge(['avatar' => $name]);
        // }
        // $file = $request->file('avatar');
        // $name = Str::random(10);
        // $url = \Storage::putFileAs('avatars', $file, $name.'.'.$file->extension());
        // $avatar = $request->file('avatar');
        //     $avatar_path =  '/' . $avatar;

        //     //save the avatar
        // //     $request->file('avatar')->storeAs('avatars', $avatar_path, '');
        // if($request->avatar){
        //     $image = $request->get('avatar');
        //     $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        //     \Image::make($request->get('avatar'))->save(public_path('avatars/').$name);
           
        // }

        // $user=User::create($request->all());
        
       
        // $input=$req->all();

        // if ($image = $req->file('avatar')) {
        //     $destinationPath = 'avatars/';
        //     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($destinationPath, $profileImage);
        //     $user->avatar = "$profileImage";
        //     $user->save();
        // }
        // User::create($input);
        // $user->save();
        // return ['url'=>env('APP_URL').'/'.$url];
        // return response()->json('user created!');
        // return $user;

    }
    
    }}
