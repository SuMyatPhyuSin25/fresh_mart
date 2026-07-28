<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    //

    public function cart(){

    $carts = Cart::select('carts.id as cart_id', 'carts.qty', 'products.id as product_id', 'products.name', 'products.price', 'products.image')
                 ->leftJoin('products', 'carts.product_id', 'products.id')
                 ->where('carts.user_id', Auth::user()->id)
                ->get();

                
        $totalAmount = 0;
       foreach($carts as $item){
        $totalAmount += $item->price * $item->qty;
       }

       $allTotal = $totalAmount + 5000;
       

      return view('customer.cartPage', compact('carts', 'totalAmount', 'allTotal'));
    }

    public function addToCart(Request $request){

        Cart::create([
               'user_id'=>Auth::user()->id,
             'product_id'=>$request->product,
             'qty'=>$request->qty,

        ]);

        Alert::success('Add to cart success', 'Product is added to cart successfully!');

             return to_route('customer.Cart');
            // return to_route('paymentPage');
        


    }

    
    public function cartDelete(Request $request){

            // logger($request->all());
            $cartId = $request['cartId'];
            // logger($cartId);
            Cart::where('id', $cartId)->delete();

             

             return response()->json([
                'status'=>'success',
                'message'=>'Cart is deleted successfully!'

             ], 200);


    }



     public function tempStorage(Request $request){

        $orderTemp = [];

        foreach($request->all() as $item){

           array_push($orderTemp, [
            
            'user_id'=>$item['user_id'],
            'product_id'=>$item['product_id'],
            'count'=>$item['count'],
            'status'=>$item['status'],
            'order_code'=>$item['order_code'],
            'totalAmt'=>$item['totalAmt'] 
           
         

           ]);
        }

        // logger($orderTemp);
        Session::put('tempCart', $orderTemp);

        return response()->json([
            'status'=>'success',
             'message'=>'temp message stores successfully!'
        ], 200);


    }

     public function paymentPage(){

      $paymentData = Payment::select('id', 'account_name','account_number', 'account_type')
                                ->orderBy("account_name", "asc")->get();

        $orderData= Session::get('tempCart');

        // dd($orderData);

      return view('customer.paymentPage', compact('paymentData', 'orderData'));

    }




    public function order(Request $request){

        $request->validate([

            'name'=>'required|min:2|max:30',
            'phone'=>'required|string|min:2',
            'address'=>'required|min:10|max:50',
            'paymentType'=>'required',
            'payslipImage'=>'required|file|mimes:png,jpg,jpeg,avif,webp,svg'

        ]);

        $orderData = Session::get('tempCart');

        $paymentHistoryData = [
            'user_name'=>$request->name,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'payment_id'=>$request->paymentType,
            'order_code'=>$request->orderCode,
            'totalAmt'=>$request->totalAmount,
            'user_id'=>Auth::id(),
        ];

        if($request->hasFile("payslipImage")){

            $fileName = uniqid() . $request->file("payslipImage")->getClientOriginalName();
            $request->file("payslipImage")->move(public_path(). "/payslipImage/", $fileName);
            $paymentHistoryData['payslip_image'] = $fileName;
        }

        PaymentHistory::create($paymentHistoryData);


        // OrderItem::insert($orderData);
  

        foreach($orderData as $item){

           Order::create([

            'product_id'=>$item['product_id'],
              'user_id'=>$item['user_id'],
               'order_code'=>$item['order_code'],
            'totalAmt'=>$item['totalAmt'],
              'status'=>$item['status'],
            'count'=>$item['count'],
          
           
           ]);

             OrderItem::create([

    'product_id' => $item['product_id'],
    'order_code' => $item['order_code'],
    'totalAmt'   => $item['totalAmt'],
]);




           Cart::where('user_id', $item['user_id'])->where('product_id', $item['product_id'])->delete();
        }

         Alert::success('Thanks for your order', 'Order is created successfully!');

         return to_route('customer.Cart');

          
    }


    public function orderList()
{
    $orderList = Order::where('user_id', Auth::id())
        ->whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')
                ->from('orders')
                ->where('user_id', Auth::id())
                ->groupBy('order_code');
        })
        ->orderBy('created_at', 'desc')
        ->get();

    return view('customer.orderListPage', compact('orderList'));
}




}
