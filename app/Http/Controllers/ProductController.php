<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    //

    public function productList($action ='defaultAmount'){


     $products=Product::leftJoin('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.*', 'categories.name as category_name')
                    ->when($action =='lowAmt', function($query){
                       $query->where('products.stock', '<=', 50);

                    })
                    ->when(request('searchKey'), function($query){
                        $query->where(function($q){
                            $q->where('products.name', 'like', '%' . request('searchKey') . '%')
                              ->orWhere('categories.name', 'like', '%' . request('searchKey') . '%');
                        });
                    })
                  
                    ->paginate(3);

        $totalProducts = Product::count();

      return view('admin.product.productPage', compact('products', 'totalProducts'));
    }

    public function showDetailProduct($id){


      $detailProduct = Product::leftJoin('categories', 'products.category_id', '=', 'categories.id')
                              ->select('products.*', 'categories.name as category_name')
                              ->where('products.id', $id)
                              ->orderBy('created_at', 'desc')
                              ->first();



      return view('admin.product.productDetailPage', compact('detailProduct'));

    }

  
    public function editProduct($id,$slug){

    $category = Category::get();

    $product = Product::where('id', $id)->first();
  
    $productSlug = Product::where('slug', $slug)->firstOrFail();

    return view('admin.product.productEditPage', compact('product', 'productSlug', 'category'));
}

    public function updateProduct(Request $request){

        $this->checkValidation($request, 'update');
        $data = $this->getData($request);
        // dd($request->all());
        // if($request->hasFile('image')){

        //   $oldImage = $request -> productImage;

        //     if(file_exists(public_path('/productImage/'. $oldImage))){

        //          unlink(public_path('/productImage/'.$oldImage));
        //     }

        //     $filename = uniqid().$request->file('image')->getClientOriginalName();//adding new image in update page.
        //     $request->file('image')->move(public_path() . 'productImage/'. $filename);
        //     $data['image'] = $filename;


        // }else{

        //    $data['image'] = $request->productImage;

        // }

          if($request->hasFile('image')){

            $oldImage = $request->productImage;
            
            if(file_exists(public_path('/productImage/' . $oldImage))){
              unlink(public_path('/productImage/' . $oldImage));
            }
            $filename = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path() . '/productImage/', $filename);
            $data['image'] = $filename;
          }else{

            $data['image'] = $request->productImage;
          }

            Product::where('id', $request->productId)->update($data);

          Alert::success('Success', 'Product updated successfully.');


        return to_route('product#list');


    }


    public function deleteProduct($id){

      $deleteProduct = Product::find($id);
      $productImage = $deleteProduct['image'];
    

      if(file_exists(public_path('/productImage/'.$productImage))){

        unlink(public_path('/productImage/'. $productImage));
      }
      Product::destroy($id);


      // Product::where('id', $id)->delete();

      Alert::success('Success Title', 'Product is deleted successfully.');

      return to_route('product#list');
      
    }

    public function addProduct(){

     $categories = Category::select('id','name')->get();

     return view('admin.product.productCreatePage', compact('categories'));

    }

    public function createProduct(Request $request){

        $this->checkValidation($request, "create");
        $data = $this->getData($request);

        if($request->hasFile('image')){

           $filename = uniqid() . $request->file('image')->getClientOriginalName();
           $request->file('image')->move(public_path() . "/productImage/", $filename);
           $data['image'] = $filename;
        }

        Product::create($data);

        Alert::success('Success', 'New product is created successfully.');

        return to_route('product#list');


    }



    public function getData($request){
        
     return [
        'name'=>$request->name,
        'price'=>$request->price,
        'description'=>$request->description,
        'image'=>$request->image,
        'category_id'=>$request->categoryId,
        'stock'=>$request->stock
     ];

    }

    private function checkValidation($request, $action){

      $rules = [
        'name'=>'required|min:3|max:50|unique:products,name,'.$request->id,
        'categoryId'=>'required|exists:categories,id',
        'price'=>'required|numeric|min:2',
        'description'=>'required|min:10',
        'stock'=>'required|min:1|numeric'

      ];

      $rules['image'] = $action== 'create' ? 'required|file|mimes:jpg,png,jpeg,webp,svg,avif' : 'file|mimes:jpg,jpeg,png,webp,svg,avif';


      $messages = [
        'image.required'=>'Product image is required',
        'name.required'=>'Product name is required!',
        'categoryId.required'=>'Product category is required!',
        'price.required'=>'Product price is required!',
        'description.required'=>'Product description is required!',
        'stock.required'=>'Product stock is required!'
      ];

      $request->validate($rules, $messages);
       
    }


}
