<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    function index($user_id)
    {
        $products = Product::all()->toArray();

        $latest_order = Order::where("owner_id", "=", $user_id)->latest()->first();

        $data["products"] = $products;
        if ($latest_order) {
            $data["latest_order"] = $latest_order->products;
        } else {
            $data["latest_order"] = [];
        }

        return $data;
    }
}
