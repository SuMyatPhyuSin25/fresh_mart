<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentHistory;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    //
     public function orderList(){

      $orders = Order::select('products.id as product_id', 'products.stock','orders.count', 'orders.id', 'orders.order_code', 'orders.created_at', 'orders.status', 'users.name')
                    ->leftJoin('users', 'orders.user_id','=', 'users.id')
                    ->leftJoin('products', 'products.id', 'orders.product_id')
                        ->when(request('searchKey'), function($query){
                                $query->whereAny(['users.name', 'orders.order_code'], 'like', '%' .request('searchKey'). '%' );
                            })
                 
                    ->groupBy('order_code')
                    ->orderBy('orders.created_at', 'desc')
                    ->paginate(3);
                    

                    // dd($orders->toArray());

    return view('admin.order.orderListPage', compact('orders'));

    }

    
    //order detail
    public function orderDetail($orderCode){

    $order = Order::select('orders.id as order_id', 'orders.order_code', 'orders.count', 'orders.status', 'orders.created_at', 'products.id', 'products.price', 'products.stock', 'products.image', 'products.name', 'users.id as user_id', 'users.name', 'users.phone', 'users.address', 'orders.totalAmt')
                    ->leftJoin('products', 'orders.product_id', '=', 'products.id')
                    ->leftJoin('users', 'users.id', 'orders.user_id')
                    ->where('orders.order_code', $orderCode)
                    ->get();

               

$paymentHistory = PaymentHistory::select('payment_histories.*', 'payments.account_type as payment_type')
                                ->leftJoin('payments', 'payments.id', 'payment_histories.payment_id')
                                ->where('order_code', $orderCode)->first();

              

// $paymentHistory = PaymentHistory::where('order_code', $orderCode)->get();


                $status = true;

                foreach($order as $item){

                  if($item->count <= $item->stock){

                    $status = true;
                  }else{

                        $status=false;
                  }
                }

                    // dd($orders->toArray());
       return view('admin.order.orderDetailPage', compact('order', 'paymentHistory', 'status'));
    }




    public function orderReject(Request $request){

      //  logger($request->all());

      Order::where('order_code', $request->orderCode)->update([
        'status'=> 2

      ]);

       Alert::success('Sorry!','Order is rejected');

      return response()->json([
        'status' => 'success',
        'message' => 'order is rejected successfully!'

      ], 200);

  
    }


    public function orderStatusChange(Request $request){

        // logger($request->all());

      Order::where('order_code', $request->order_code)->update([
        'status'=>$request->status
      ]);

    

      return response()->json([
        'status' => 'success',
        'message' => 'order status is changed successfully!'

      ], 200);

      
    }

    public function orderConfirm(Request $request){

        // logger($request->all());

    
       $rawOrderList = $request->query('orderList');

    if (!$rawOrderList) {
      
        logger('orderList missing', $request->all());
        return response()->json(['error' => 'orderList missing'], 400);
    }

    $orderList = json_decode($rawOrderList, true);
       
    if (!is_array($orderList)) {

        logger('Invalid orderList JSON', ['raw' => $rawOrderList]);
        return response()->json(['error' => 'Invalid orderList'], 400);
    }

    Order::where('order_code', $orderList[0]['orderCode'])
        ->update(['status' => 1]);

    foreach ($orderList as $item) {
        Product::where('id', $item['productId'])
            ->decrement('stock', (int) $item['orderCount']);
    }
       
       
       Alert::success('Success','Order is confirmed successfully.');
     

         return response()->json([
        'status' => 'success'
    ], 200);

   

    }

    
    public function saleInfo(){

      $saleOrders = Order::select('orders.count', 'orders.id', 'orders.order_code', 'orders.created_at', 'orders.status', 'users.name')
                    ->leftJoin('users', 'orders.user_id','=', 'users.id')
                   ->where('orders.status',1)
                    ->when(request('searchKey'), function($query){
                                $query->whereAny(['users.name', 'orders.order_code'], 'like', '%'                    .request('searchKey'). '%' );
                            })
                  
                    ->groupBy('orders.order_code')
                    ->paginate(3);

                  

      return view('admin.sale.saleInformation', compact('saleOrders'));


    }

}
