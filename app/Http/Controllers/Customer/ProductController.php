<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class ProductController extends Controller
{
    //

    public function productDetail($id){

    $currentProduct = Product::findOrFail($id);
        
        $productDetail = Product::select(
            'products.id as product_id',
            'products.stock',
            'products.name',
            'products.price',
            'products.description',
            'products.image',
            'categories.name as category_name',
            'categories.id as category_id'
        )
        ->leftJoin('categories', 'products.category_id', 'categories.id')
        
        ->when(request('searchKey'), function($query){
            $query->where('products.name', 'like', '%'.request('searchKey').'%');
        })
        ->where('products.id', $id)
        ->first();

        $productLists = Product::select(
            'products.id as product_id',
            'products.stock',
            'products.name',
            'products.price',
            'products.description',
            'products.image',
            'categories.name as category_name',
            'categories.id as category_id'
        )
        ->leftJoin('categories', 'products.category_id', 'categories.id')
        ->where('products.category_id',$currentProduct->category_id)
        ->where('products.id', '!=', $currentProduct->id)
         ->distinct()//for not showing same product multiple times
        
        ->get(); 
    

        $comments = Comment::select('comments.id as comment_id', 'comments.message', 'comments.created_at', 'users.id as user_id', 'users.profile', 'users.name')
                            ->leftJoin('users', 'comments.user_id', 'users.id')
                         ->where('comments.product_id', $id)
                         ->orderBy('created_at', 'desc')->get();

          $userRatings = Rating::where('product_id', $id)->avg('rate_count');

         $ratingFormat = number_format($userRatings);


        $userRating = Rating::where('product_id', $id)->where('user_id', Auth::user()->id)->value('rate_count');

    //    dd($userRating);

        return view('customer.productDetail.productDetailPage', compact('productDetail', 'productLists', 'comments', 'ratingFormat', 'userRating'));


    }

    // public function postComment(Request $request){
      
    //     // dd($request->all());
    //     Comment::create([
            
    //         'message' => $request->comment,
    //         'user_id' =>Auth::id(),
    //         'product_id' => $request->productId,
    //     ]);

    //     Alert::success('Comment Posted', 'Your comment has been posted successfully!');

    //     return back();

    // }

    // public function deleteComment($id){
    //     Comment::where('id', $id)->delete();

    //     Alert::success('Comment Deleted', 'Your comment has been deleted successfully!');

    //     return back();
    // }

    // public function postRating(Request $request){
    //     // dd($request->all());
    //    Rating::updateOrCreate([
    //     'user_id' => Auth::id(),
    //     'product_id' => $request->product_id,
    //    ],
    //    [
    //      'product_id' => $request->product_id,
    //      'user_id' => Auth::id(),
    //     'rate_count' => $request->productRating,
    //    ]);

    //    Alert::success('Rating Posted', 'Your rating has been posted successfully!');

    //     return back();
    // }
}
