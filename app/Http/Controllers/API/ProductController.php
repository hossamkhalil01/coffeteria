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

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'photo' => 'required'
        ]);

        if($request->photo){

            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);
           
        }

        Product::create($request->all());

        return ['message' => 'Success'];

    }

    public function show(Product $product)
    {    
        return $product;
    }
    // public function show(Product $product)      //$id
    // {
    //     return $product;
    // }


    public function update(Request $request, $id)
    {
        $Product = Product::find($id);

        $this->validate($request,[
            'name' => 'required|string|max:191',
            'photo' => 'required'
        ]);

        $currentPhoto = $Product->photo;

        if($request->photo != $currentPhoto){

            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/').$currentPhoto;

            if(file_exists($userPhoto)){

                @unlink($userPhoto);
                
            }
           
        }

        $Product->update($request->all());

        return ['message' => 'Success'];
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
