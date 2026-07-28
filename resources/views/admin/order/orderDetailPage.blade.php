@extends('admin.layouts.master');


@section('content')

<!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

              
                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <a href="{{route('order#List')}}" class=" text-black m-3"> <i class="fa-solid fa-arrow-left-long"></i> Back</a>

                    <!-- DataTales Example -->

                         
                     <div class="row">
                        
                      
                        <div class="card col-5 shadow-sm m-4 col">
                            <div class="card-header bg-success text-white w-full">
                                <div class="w-full">Customer information</div>
                            </div>
                            
                            <div class="card-body">
                                
                              
                                <div class="row mb-3">
                                    <div class="col-5">Name :</div>
                                    <div class="col-7">{{$order[0]->name}}</div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-5">Phone :</div>
                                    <div class="col-7">
                                    {{$order[0]->phone}}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-5">Address :</div>
                                    <div class="col-7">
                                     {{-- {{$paymentHistory->address}} --}}
                                      {{$order[0]->address}}

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-5">Order Code :</div>
                                    <div class="col-7" id="orderCode">{{$order[0]->order_code}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-5">Order Date :</div>
                                    <div class="col-7">{{$order[0]->created_at->format("j-F-Y")}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-5">Total Price :</div>
                                    <div class="col-7">
                                    
                                      {{$order[0]->totalAmt}} mmk
                                        <small class=" text-danger ms-1">( Contain Delivery Charges )</small>
                                    </div>
                                </div>
                                 
                            </div>
                            
                        </div>
                    


 
              

                        <div class="card col-5 shadow-sm m-4 col">
                            <div class="card-header bg-success text-white w-full">
                                <div class="">Payment information</div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-5">Contact Phone :</div>
                                    <div class="col-7">{{ $paymentHistory->phone}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-5">Payment Method :</div>
                                    <div class="col-7">{{  $paymentHistory->payment_type }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-5">Purchase Date :</div>
                                    <div class="col-7">{{ $paymentHistory->created_at->format("j-F-Y")}}</div>
                                </div>
                                <div class="row mb-3">
                                    <img style="width: 150px" src="{{ asset('payslipImage/'.$paymentHistory->payslip_image)}}" class=" img-thumbnail">
                                </div>
                            </div>
                            
                        </div>
                      
                    </div>
                
                 


                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="d-flex justify-content-between">
                                <div class="">
                                    <h6 class="m-0 font-weight-bold text-primary">Order Board</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover shadow-sm data-table" id="productTable">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th class="col-2">Image</th>
                                            <th>Name</th>
                                            <th>Order Count</th>
                                            <th>Available Stock</th>
                                            <th>Product Price (each)</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($order as $item)
                                        <tr>
                                            <input type="hidden" class="productId" value="{{ $item->id}}">
                                            <input type="hidden" class="productOrderCount" value="{{ $item->count}}">

                                            <td>
                                                <img src="{{asset('productImage/'. $item->image)}}" class=" w-50 img-thumbnail">
                                            </td>
                                            <td>{{ $item->name}}</td>
                                            <td>{{ $item->count}} @if($item->count > $item->stock ) <span class="text-danger" > (Out of stock)</span>  @endif</td>
                                            <td>{{ $item->stock}}</td>
                                            <td>{{ $item->price}} mmk</td>
                                            <td>{{ $item->price * $item->count}} mmk</td>
                                        </tr>

                                        @endforeach
                                    </tbody>

                                </table>

                            </div>
                             <div class="card-footer d-flex justify-content-end">
                            <div class="">
                                
                              @if($status)

                              <input type="button" id="btn-order-confirm" class="btn btn-success rounded shadow-sm"
                                    value="Confirm Order">


                              @endif
                                <input type="button" id="btn-order-reject" class="btn btn-danger rounded shadow-sm"
                                    value="Reject Order">
                            </div>
                        </div>
                        </div>
                       
                    </div>

                </div>




@endsection


@section('script-content')


<script>

$(document).ready(function () {

    $('#btn-order-reject').on('click', function (e) {

        e.preventDefault(); // prevents unwanted form submit if button is inside a form

        const orderCode = $('#orderCode').text();

        if (!orderCode) {
            alert('Order code not found');
            return;
        }

        $.ajax({
            type: 'GET',
            url: '/admin/order/orderReject',
            data: { orderCode: orderCode },
            dataType: 'json',
            success: function (response) {
                console.log('Order rejected:', response);
                // handle success UI here
                response.status== 'success' ? location.href = "/admin/order/orderList" : location.href="";
            },
          
        });
    });
});




    $('#btn-order-confirm').on('click', function (e) {

        e.preventDefault(); // prevents unwanted form submit if button is inside a form

        const orderCode = $('#orderCode').text();
        const orderList = [];

        $('.data-table tbody tr').each(function(index, row){

           const productId = $(row).find('.productId').val();
           const orderCount = $(row).find('.productOrderCount').val();


           orderList.push({

            'productId': productId,
            'orderCount': orderCount,
            'orderCode': orderCode


        });

           console.log(orderList);
        })

        if (!orderCode) {
            alert('Order code not found');
            return;
        }

        $.ajax({
            type: 'get',
            url: '/admin/order/orderConfirm',
             data: {
        orderList: JSON.stringify(orderList) // 🔑 MUST be key=value
    },
            dataType: 'json',
            success:function(response){
                response.status=='success' ? location.reload() : "";
                // console.log(response);
            }


        })

   

                
        });

        </script>

    
   @endsection







