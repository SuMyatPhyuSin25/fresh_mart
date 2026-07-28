@extends("admin.layouts.master");

@section('content')

                <div class="container">
                    <div class=" d-flex justify-content-between my-2">
                          {{-- <h4 class="fw-bold text-success">Order Lists</h4> --}}
                           <h1 class="h3 mb-3 text-gray-800 text-center">Order List</h1>
                        <div class=""></div>
                        <div class="">
                            <form action="{{route('order#List')}}" method="get">

                <div class="input-group">
                    <input type="text" name="searchKey" value="{{request('searchKey')}}" class=" form-control"
                        placeholder="Enter Search Key...">
                    <button type="submit" class=" btn bg-dark text-white"> <i
                            class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
                            
                        </div>
                    </div>
                    <div class="row">
                
                        <div class="col">
                              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Click order code for order details!!!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                            <table class="table table-hover shadow-sm ">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Date</th>
                                        <th>Order Code</th>
                                        <th>Customer Name</th>
                                        <th>Order Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $item)
                                    <tr>

                                        <td>{{$item->created_at->format("j-F-Y")}}</td>
                                        <td id="orderCode"><a href="{{route('orderDetail', ['orderCode' => $item->order_code])}}">{{$item->order_code}}</a></td>
                                        
                                        <td>{{$item->name}}</td>
                                        <td>
                                            <select name="statusValue" id="statusValue" class="form-select form-select-sm status-change"  >
                                                <option value="0" @if($item->status==0) selected @endif class="p-3"> Pending   </option>
                                                @if($item->count <= $item->stock) 
                                                <option value="1"  @if($item->status==1) selected @endif>Success</option>
                                                
                                                @endif
                                                
                                                <option value="2"  @if($item->status==2) selected  @endif>Reject</option>
                                            </select>
                                        </td>

                                        <td>
                                            @if($item->status==0)
                                             <i class="fa-solid fa-spinner text-warning"></i>
                                             @elseif($item->status==1)
                                             <i class="fa-solid fa-check text-success"></i>
                                             @else
                                                <i class="fa-solid fa-x text-danger"></i>
                                                @endif
                                              
                                        </td>
                                        
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                              <span class=" d-flex justify-content-end">{{$orders->links()}}</span>

                        </div>
                    </div>
                </div>


@endsection


@section('script-content')

<script>
$(document).ready(function () {
    $('.status-change').on('change', function (e) {
        e.preventDefault(); // prevents unwanted form submit if button is inside a form

        const value = $(this).val();

        const orderCode = $(this).parents('tr').find('#orderCode').text();
        // console.log(orderCode);

        console.log(value);

        let data = {
            'order_code':orderCode,
            'status': value

        };

            $.ajax({
            type: 'GET',
            url: '/admin/order/orderStatusChange',
            data: data,
            dataType: 'json',
            success: function (response) {
               
                response.status== 'success' ? location.reload() : "";
            },
          
        });




      
        });
    });

</script>


@endsection