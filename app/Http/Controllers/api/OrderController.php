<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;
use App\Http\Resources\OrderResource;
use DateTime;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        //
        $user = User::find($user_id);

        if ($user) {
            return new OrderResource(Order::where("owner_id", "=", $user_id)->paginate());
        } else {
            return response()->json(["data" => []]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($user_id, Request $request)
    {
        $user = User::find($user_id);
        if ($user) {
            $validatedData = $request->validate([
                'room_id' => 'required',
                'ordered_products' => 'required|array|min:1',
                'notes' => 'nullable'
            ]);
            // dd($validatedData);
            // return $validatedData;
            $order = new Order(["notes" => $validatedData["notes"], "room_id" => $validatedData["room_id"]]);
            $user->orders()->save($order)->products()->attach($validatedData["ordered_products"]);

            return response()->json(["message" => "Order Created"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function get_orders_within_date_range($user_id, Request $request)
    {
        //
        $user = User::find($user_id);
        // dd(date_add(new DateTime($request->from), date_interval_create_from_date_string('1 day')));

        // $from = date_add(new DateTime($request->from), date_interval_create_from_date_string('1 day'));
        $from = new DateTime($request->from);
        $to = date_add(new DateTime($request->to), date_interval_create_from_date_string('1 day'));

        if ($user) {
            return new OrderResource(Order::where([["owner_id", "=", $user_id], ["created_at", ">=", $from],  ["created_at", "<=", $to]])->paginate());
        } else {
            return response()->json(["user" => Null]);
        }
    }
}
