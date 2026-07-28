@extends('customer.layouts.master')

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

<div class="container py-5 mt-5">

<div class="card shadow border-0">

<div class="card-body p-5">

<h2 class="text-primary mb-4">
Return Policy
</h2>

<p>
We accept returns within 7 days of delivery.
</p>

<ul>

<li>Item must be unused.</li>

<li>Original packaging is required.</li>

<li>Receipt or proof of purchase is required.</li>

<li>Refunds are processed after inspection.</li>

</ul>

<h4>Non-returnable Items</h4>

<ul>

<li>Damaged by customer</li>

<li>Used items</li>

<li>Personal care products</li>

</ul>

</div>

</div>

</div>

@endsection