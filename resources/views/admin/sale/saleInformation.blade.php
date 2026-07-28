@extends('admin.layouts.master');

@section('content')


     <div class="container">
                    <div class=" d-flex justify-content-between my-2">
                       
                         <h1 class="h3 mb-3 text-gray-800 text-center">Sale Information</h1>
                          
                        <div class="">
                            <form action="{{route('saleInfo')}}" method="get">

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
                                    @foreach($saleOrders as $item)
                                    <tr>

                                      <td>{{ $item->created_at->format('j-F-Y')}}</td>
                                        {{-- <td id="orderCode">{{ $item->order_code}}</td> --}}
                                          <td id="orderCode"><a href="{{route('orderDetail', ['orderCode' => $item->order_code])}}">{{$item->order_code}}</a></td>
                                        
                                        <td>{{ $item->name}}</td>
                                        <td>
                                            <!-- success order -->
                                             @if($item->status ==1)

                                             <p>Success</p>
                                             @endif

                                        </td>
                                        <td>
                                           
                                            
                                             <i class="fa-solid fa-check btn-sm btn-success"></i>
                                             
                                        </td>
                                     
                                        
                                       
                                        
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                               <span class=" d-flex justify-content-end">{{ $saleOrders->links()}}</span>
                        </div>
                    </div>
                </div>




@endsection