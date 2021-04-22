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

        $userPhoto = public_path('img/profile/') . $currentPhoto;

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
        // $this->validate($request,[
        //     'name' => 'required|string|max:191',
        // ]);

        // var_dump($request->image);
        $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'image' => 'required',
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
        //get single user details
        $product  = Product::findOrfail($id);
        // console.log($product);
        return $product;
    }
    public function update(Request $request, $id)
    {
        //update user data
        if ($request->isMethod('put')) {

            $product  = Product::findOrfail($id);
            $product->name = $request->get('name');
            $product->price = $request->get('price');
            $product->is_available = $request->get('is_available');
            $product->category_id = $request->get('category_id');
            
            $name = "";
    
    
            if ($request->image) {
    
                $name = time() . '.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
                \Image::make($request->image)->save('storage/img/' . $name);
    
                $request->merge(['image' => $name]);
            }
            $product->image= $request->get('image');

           
            // console.log($product);
            $product->save();
            return $product;
        } else {
            return ['message' => 'failed'];
        }
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
