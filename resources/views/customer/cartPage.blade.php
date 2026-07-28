@extends('customer.layouts.master');

@section('content')

    <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                         <form action="{{route('shop#Page')}}" method="GET" class="w-75 input-group mx-auto">
                              @csrf
                        <div class="input-group w-75 mx-auto d-flex">
                           <input type="search" name="searchKey" value="{{request('searchKey')}}" class="form-control" placeholder="Search your fruit..." aria-describedby="search-icon-1">
                            
                            <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                              
                               
                               
                        </div>
                            </form>
                           
                          
                        </div>
                    </div>
                </div>
            </div> 

 <!-- Cart Page Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table" id="productTable">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>


                    @foreach($carts as $item)

                        <tr>
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('productImage/'. $item->image)}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                        alt="">
                                </div>
                            </th>
                            <td>
                                <p class="mb-0 mt-4">{{$item->name}}</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4 price"> {{$item->price}} mmk</p>
                            </td>
                            <td>
                                <div class="input-group quantity mt-4" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border" id="btn-minus">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control qty form-control-sm text-center border-0 qty"
                                        value="{{$item->qty}} "> <span > kg</span>

                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border" id="btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 mt-4 total">{{$item->price * $item->qty}} mmk</p>
                            </td>
                            <td>
                                <input type="hidden" class="cartId" value="{{$item->cart_id}}">
                                <input type="hidden" class="userId" value="{{Auth::user()->id}}">
                                <input type="hidden" class="productId" value="{{$item->product_id}}">
                                <button class="btn btn-md rounded-circle bg-light border mt-4 btn-remove" >
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                            </td>

                        </tr>

                        @endforeach


                    </tbody>
                </table>
            </div>


            @if(count($carts) >= 1)
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0" id="subtotal"> {{$totalAmount}} mmk</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Delivery </h5>
                                <div class="">
                                    <p class="mb-0"> 5000 mmk </p>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4 " id="finalTotal">{{$allTotal }} mmk</p>
                        </div>

                        <button id="btn-checkout"
                            class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                            type="button" @if(count($carts)==0) disabled @endif>Proceed to Checkout</button>
                         


                    </div>
                </div>
            </div>
            @else

            <div class="text-center text-success font-bold fs-3">Your cart is empty now!</div>

            @endif


        </div>
    </div>
    <!-- Cart Page End -->


    





@endsection


@section('js-content')

<script>

    $(document).ready(function(){

            $('.btn-minus').click(function(){
           priceCalculation(this);
           totalCalculation();


            });

              $('.btn-plus').click(function(){
                
               priceCalculation(this);
               totalCalculation();
            });


            function priceCalculation(element){

                 let parentNode = $(element).parents("tr");
                let price = parentNode.find(".price").text().replace("mmk", "");
                let qty = parentNode.find(".qty").val();
                //  console.log($price);
                 parentNode.find(".total").text((price * qty) + "mmk");


            }

        function totalCalculation() {
            let total = 0;

          $("#productTable tbody tr").each(function (index, item) {

                let rowTotal = $(item)
                .find(".total")
                .text()
                .replace("mmk", "");

                total += Number(rowTotal);

            });

            console.log(total);

           
            $('#subtotal').html(`${total} mmk`);


            
            // $('#findtotal').html(`${total + 500}`);



            $('#finalTotal').html(`${total + 5000}  mmk`);
            }


                $(".btn-remove").click(function(){

                   let parentNode = $(this).closest("tr");
                   let cartId = parentNode.find(".cartId").val();
              
                   let deleteData = {
                      'cartId' : cartId

                   }

                   $.ajax({
                     type: 'get',
                     url: '/customer/cartDelete',
                     data: deleteData,
                     dataType: 'json',
                     success: function(response){
                        // console.log(response);
                            response.status=='success' ? location.reload() : ' ';

                     }

                   })
                })

                $("#btn-checkout").click(function(){

                    let orderList = [];
                      let parentNode = $(this).closest("tr");
                   
                    let userId = $('.userId').val();
                    let orderCode = "FreshMartODC_" + Math.floor(Math.random() * 100000);
                    let orderStatus="confirmed";
                    // console.log(userId, orderCode);
                      let finalTotal = $('#finalTotal').text().replace("mmk", "");

                    $("#productTable tbody tr").each(function(index, row){  
                        let productId = $(row).find('.productId').val();
                        let qty = $(row).find('.qty').val();
                        finalTotal = $('#finalTotal').text().replace("mmk", "");
    

                         orderList.push({
                           
                            'product_id': productId,
                            'user_id': userId,
                            'count': qty,
                            'status':0,
                            'order_code': orderCode,
                            'totalAmt': finalTotal,
                            
     

                         }
    
                         )


                    } )

                    // console.log(orderList);
                    $.ajax({
                        type: 'get',
                        url: '/customer/tempStorage',
                        data: Object.assign({}, orderList),
                        dataType: 'json',
                        success: function(response){
                            response.status=="success" ? location.href = '/customer/paymentPage' : location.reload();
                        }

                    })

                })



            });

               



    

    
</script>

@endsection