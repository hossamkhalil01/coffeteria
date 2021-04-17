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
        
        return Product::latest()->paginate(2);
         
    }
    public function destroy($id)
    {
        $Product = Product::findOrFail($id);

        $Product->delete();

        $currentPhoto = $Product->photo;

        $userPhoto = public_path('img/profile/').$currentPhoto;

        if(file_exists($userPhoto)) {

            @unlink($userPhoto);
                
        }

        return [
         'message' => 'Photo deleted successfully'
        ];
    }

    
}
