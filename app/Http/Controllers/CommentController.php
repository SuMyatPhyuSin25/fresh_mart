<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CommentController extends Controller
{
    //
    
    public function postComment(Request $request){
      
        // dd($request->all());
        Comment::create([
            
            'message' => $request->comment,
            'user_id' =>Auth::id(),
            'product_id' => $request->productId,
        ]);

        Alert::success('Comment Posted', 'Your comment has been posted successfully!');

        return back();

    }

    public function deleteComment($id){
        Comment::where('id', $id)->delete();

        Alert::success('Comment Deleted', 'Your comment has been deleted successfully!');

        return back();
    }
}
