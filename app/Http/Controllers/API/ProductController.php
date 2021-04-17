<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Product;
use App\Models\Product;


class ProductController extends Controller
{
    public function index()
    {
        
        return Product::latest()->paginate(1);
         
    }

    
}
