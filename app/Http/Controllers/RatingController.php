<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RatingController extends Controller
{
    //
    
    public function postRating(Request $request){
        // dd($request->all());
       Rating::updateOrCreate([
        'user_id' => Auth::id(),
        'product_id' => $request->product_id,
       ],
       [
         'product_id' => $request->product_id,
         'user_id' => Auth::id(),
        'rate_count' => $request->productRating,
       ]);

       Alert::success('Rating Posted', 'Your rating has been posted successfully!');

        return back();
    }
}
