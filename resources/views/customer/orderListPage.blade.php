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

   
    <div class="container ">
        <div class="row">
            <table class="table table-hover shadow-sm ">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Date</th>
                        <th>Order Code</th>
                        <th>Order Status</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($orderList as $item)
                    <tr>
                        <td>{{$item->created_at->format('Y-m-d')}}</td>
                        <td>{{$item->order_code}}</td>
                        <td>
                            @if($item->status == 0)

                            <i class="fa-solid fa-spinner btn btn-sm btn-warning rounded-sm"></i><span class="m-2 text-warning">Pending</span>

                            @elseif($item->status==1)

                            <i class="fa-solid fa-check btn btn-sm btn-success rounded-sm"></i><span class="m-2 text-success">Confirmed</span>

                            @else
                            <i class="fa-solid fa-x btn btn-sm btn-danger rounded-sm"></i> <span class="m-2 text-danger">Reject</span>

                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>



@endsection