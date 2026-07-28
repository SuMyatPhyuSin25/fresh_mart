<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    //

      public function index()
    {
        return view('customer.contactPage');
    }

   public function store(Request $request)
    {
        $request->validate([
            'user_message' => 'required|string|max:1000',
        ]);

        Contact::create([
            'user_id' => Auth::id(), // logged-in user
            'user_name'=>Auth::user()->name,
            'message' => $request->user_message,
        ]);

        // return redirect()->back()->with('success', 'Message sent successfully!');
        Alert::success('Success', "Message is sent successfully!");

        return back();
    }

    // private function checkValidation($request){

    //  $rules = [
    //      'user_message' => 'required|min:2|max:50|unique:payments,account_number,'.$request->id,
           

    //   ];

      
    // }
}

