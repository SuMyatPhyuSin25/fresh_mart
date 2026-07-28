<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;


class CustomerController extends Controller
{
    //

    public function customerHome(){

      $products = Product::select('products.id','products.name', 'products.price', 'products.description','products.image','categories.name as category_name','categories.id as category_id')
                            ->leftJoin('categories', 'products.category_id', 'categories.id')
                            ->when(request('searchKey'), function($query){
                                $query->where('products.name', 'like', '%'.request('searchKey').'%');
                            })
                            ->when(request('categoryId'), function($query){
                                $query->where('categories.id', request('categoryId'));

                            })
                            ->whereBetween('products.id', [2, 12])
                               ->distinct()
                            ->orderBy('products.created_at', 'desc')
                            ->get();
      
        $carouselProducts = Product::select('products.id', 'products.name', 'products.price', 'products.description', 'products.image', 'categories.name as category_name', 'categories.id as category_id')
                                    ->leftJoin('categories', 'products.category_id', 'categories.id')
                                    ->whereBetween('products.id', [13, 16])
                                    ->orderBy('products.created_at', 'desc')
                                    ->limit(4)
                                    ->get();


      $categories = Category::select('id', 'name')->get();


        return view('customer.home.list', compact('products', 'categories', 'carouselProducts'));
    }

    public function viewShopPage(){

    $products = Product::select('products.id','products.name', 'products.price', 'products.description','products.image','categories.name as category_name','categories.id as category_id')
                            ->leftJoin('categories', 'products.category_id', 'categories.id')
                            ->when(request('category'), function($query){
                                $query->where('categories.name', request('category'));
                            })
                             ->when(request('searchKey'), function($query){
                                $query->where('products.name','like','%'.request('searchKey').'%');
                            })
                           
                            //min=true | max=true
                            ->when(request('minPrice')!=null && request('maxPrice')!=null, function($query){
                                $query->whereBetween('products.price', [request('minPrice'), request('maxPrice')]);
                              
                            })
                             //  min=true | max=false
                             ->when(request('minPrice')!=null && request('maxPrice')==null, function($query){
                                $query->where('products.price', '>=', request('minPrice'));
                                 
                             })
                             //min=false | max=true
                                ->when(request('minPrice')==null && request('maxPrice')!=null, function($query){
                                    $query->where('products.price', '<=', request('maxPrice'));
                                    
                                })
                                ->when(request('sortingType'), function($query){

                                    $sortingRules = explode(',', request('sortingType'));
                                    $query->orderBy('products.'.$sortingRules[0], $sortingRules[1]);
                                })


                            // ->orderBy('products.created_at', 'desc')
                            // ->get()
                            ->paginate(6);


     $categories = Category::select('id', 'name')->get();

      $categoriesWithCount = Category::withCount('products')->get();

        return view('customer.customerShop.customerShopPage', compact('categories', 'products', 'categoriesWithCount'));
    }
    
    public function viewAboutUs(){

       return view('customer.aboutUsPage');
    }

       public function accept()
    {
        return response()->json([
            'success' => true
        ])->cookie(
            'cookie_accepted',
            true,
            60 * 24 * 365
        );
    }

    public function reject()
{
    return response()->json([
        'success' => true
    ])->cookie(
        'cookie_rejected',
        true,
        60 * 24 * 365
    );
}

    public function remove()
    {
        return redirect()->back()
            ->withCookie(Cookie::forget('cookie_accepted'));
    }


     public function privacy()
    {
        return view('customer.privacy');
    }

    public function terms()
    {
        return view('customer.terms');
    }

    public function returns()
    {
        return view('customer.returns');
    }

    public function faq()
    {
        return view('customer.faq');
    }
}
