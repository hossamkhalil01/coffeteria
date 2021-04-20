<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;
use App\Http\Resources\OrderResource;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Date;

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
            return new OrderResource(Order::where("owner_id", "=", $user_id)->orderBy("created_at", "desc")->paginate(5));
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
                'notes' => 'nullable',
                'total_price' => 'required'
            ]);

            $order = new Order(["notes" => $validatedData["notes"], "room_id" => $validatedData["room_id"], "total_price" => $validatedData["total_price"]]);
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
    public function show($user_id, $order_id)
    {
        $user = User::find($user_id);
        if ($user) {
            $order = Order::find($order_id);
            if ($order) {
                $products = $order->products;
                return response()->json(["data" => ["products" => $products]]);
            } else {
                return response()->json(["data" => []]);
            }
        } else {
            return response()->json(["data" => []]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update($user_id, Request $request, Order $order)
    {
        $user = User::find($user_id);
        if ($user) {
            try {
                $order->update($request->all());
                return response()->json(["data" => "succeeded"]);
            } catch (\Illuminate\Database\QueryException $ex) {
                return response()->json(["data" => "failed"]);
            }
        } else {
            return response()->json(["data" => "failed"]);
        }
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
        $user = User::find($user_id);

        if ($user) {
            $validatedData = $request->validate([
                "from" => 'required|Date',
                "to" => 'required|Date'
            ]);

            $from = new DateTime($validatedData["from"]);
            $to = date_add(new DateTime($validatedData["to"]), date_interval_create_from_date_string('1 day'));

            return new OrderResource(Order::where([["owner_id", "=", $user_id], ["created_at", ">=", $from],  ["created_at", "<=", $to]])->paginate(5));
        } else {
            return response()->json(["data" => []]);
        }
    }
}
