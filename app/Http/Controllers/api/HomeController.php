<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class HomeController extends Controller
{
    function index()
    {
        // change later to get authenticated user
        $user = User::find(1);
        $products = Product::all()->toArray();

        $latest_order = Order::latest()->first();

        $data["products"] = $products;
        $data["latest_order"] = $latest_order->products;

        return $data;
    }
}
