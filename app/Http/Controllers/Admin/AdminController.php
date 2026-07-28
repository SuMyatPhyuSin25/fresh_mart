<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Order;
use App\Models\PaymentHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
 


class AdminController extends Controller
{
    //

    public function dashboard(){

        $totalSales = PaymentHistory::select('payment_histories.totalAmt')
                                  ->get();

        
            $orderRequest = Order::whereIn('orders.status', [0,1])->count();

        $registeredUser = User::distinct('users.id')
                              ->where('users.role', 'user')
                              ->count();

        $pendingOrderRequest = Order::select('orders.status')
                                    ->where('orders.status', 0)
                                    ->count();


          $confirmedOrderRequest = Order::select('orders.status')
                                        ->where('orders.status', 1)
                                        ->count();

            $rejectOrderRequest = Order::select('orders.status')
                                        ->where('orders.status', 2)
                                        ->count();

        $totalAmount = 0;

        foreach($totalSales as $item){

          $totalAmount += $item->totalAmt;

        }


     return view('admin.dashboard.main', compact('totalAmount', 'orderRequest', 'registeredUser', 'pendingOrderRequest', 'confirmedOrderRequest', 'rejectOrderRequest'));
    }

    public function viewUserMessage(){

       $messages = Contact::select('contacts.id', 'contacts.user_id', 'contacts.user_name', 'contacts.message','users.email')
                            ->leftJoin('users', 'contacts.user_id', 'users.id')
                        
                            ->orderBy('contacts.created_at', 'desc')
                            ->get();

      return view('admin.message.viewUserMessage', compact('messages'));
    }


    

    public function addNewAdmin(){

      return view('admin.account.newAdminPage');
    }


    public function createNewAdmin(Request $request){

      $this->checkValidation($request);

      User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'role'=>'admin',
          'created_at'=>Carbon::now(),
          'updated_at'=>Carbon::now()

       
      ]);
      
      Alert::Success('Success', 'New admin account is created successfully!');

      return back();


    }
    private function checkValidation(Request $request){

      $request->validate([
        'name'=>'required',
        'email'=>'required|unique:users,email',
        'password'=>'required|min:6|max:12',
        'confirmPassword'=>'required|same:password|min:6|max:12'

      ]);

    }

    

     public function adminList(){
      // dd('admin list');
      // (admin || superadmin) && searchKey

      $admins = User::select('id','name', 'nickname', 'email','address','phone','profile','created_at','updated_at','role','provider')
                 // (admin || superadmin) && searchKey
                  ->whereIn('role',['admin', 'superadmin'])
                  ->when(request('searchKey'), function($query){//searching

                    $query->whereAny(['name', 'email', 'phone', 'address', 'nickname', 'role', 'provider'], 'like','%'.request('searchKey').'%');
                  })
                  ->paginate(3)
                    ->withQueryString();

     
      return view('admin.account.adminListPage', compact('admins'));


    }

    public function userList(){

      $users= User::select('id','name','profile','nickname','email','phone','address','provider','role','created_at')
                    ->where('role','user')
                    ->when(request('searchKey'), function($query){
                      $query->whereAny(['id','name', 'email', 'phone', 'address', 'nickname', 'role', 'provider'], 'like','%'.request('searchKey').'%');
                    })
                    ->paginate(3)
                    ->withQueryString();

      return view('admin.account.userListPage',compact('users'));


    }

    public function deleteAdminAccount($id){

      User::where('id',$id)->delete();
       Alert::Success('Success', 'This admin account is deleted successfully.');

        return back();
    }
    
    public function deleteUserAccount($id){

      User::where('id',$id)->delete();
       Alert::Success('Success', 'This customer account is deleted successfully.');

        return back();
    }

    public function deleteUserMessage($id){

        Contact::where('id', $id )->delete();
        Alert::Success('Success', 'Message is deleted successfully.');

        return back();
    }


}
