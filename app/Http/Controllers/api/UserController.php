<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // check th ecurrent user
        if (Auth::user()->id != $id)
            return response(["data" => null, "message" => "unauthorized"], "401");

        $user = User::find($id);

        // validate the date
        $validator = Validator::make(
            $request->all(),
            [
                "name" => "required|string",
                "phone" => "regex:/(201)[0-9]{9}/u|nullable",
                "room_id" => "required|exists:rooms,id",
                "track" => "string|nullable",
                "branch" => "string|nullable",
            ]
        )->validate();


        $user->name = $request['name'];
        $user->phone = $request['phone'];
        $user->room_id = $request['room_id'];
        $user->track = $request['track'];
        $user->branch = $request['branch'];

        $user->save();

        return response(["data" => $user], "200");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
