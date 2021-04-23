<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Product;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;



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

        $currentPhoto = $Product->image;

        $userPhoto = public_path('img/') . $currentPhoto;

        if (file_exists($userPhoto)) {

            @unlink($userPhoto);
        }

        return [
            'message' => 'Photo deleted successfully'
        ];
    }
    public function store(Request $request)
    {
        $name = "";
        $request->validate(
            [
                'name' => 'required',
                'price' => 'required | max : 200',
                'category_id' => 'required',

            ]
              
          );

        


        if ($request->image) {

            $name = time() . '.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save('storage/img/' . $name);

            $request->merge(['image' => $name]);
        }

        Product::create($request->all());

        return ['message' => 'Success'];
    }

    public function getCategories()
    {
        return Category::all();
    }

    public function edit($id)
    {
    
        $product  = Product::findOrfail($id);
       
        return $product;
    }
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required',
                'price' => 'required | max : 200',
                'category_id' => 'required',
            ]
              
          );
        
        $product= Product::find($id);

    
        $currentPhoto = $product->image;

        if($request->image != $currentPhoto){

            $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save('storage/img/' . $name);
            $request->merge(['image' => $name]);

            $productPhoto = 'storage/img/'.$currentPhoto;

            if(file_exists($productPhoto)){

                @unlink($productPhoto);
                
            }
           
        }

        $product->update($request->all());

        return ['message' => 'Success'];

    }
  
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }



    public function addCategory(Request $request)
    {      $request->validate(
        [
            'label' => 'required',
           
        ]
          
      );
        Category::create($request->all());

        return ['message' => 'Success'];
    }
}
