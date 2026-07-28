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
                Privacy Policy
            </h2>

            <p>
                Your privacy is important to us. This policy explains how we collect,
                use and protect your personal information.
            </p>

            <h4>Information We Collect</h4>

            <ul>
                <li>Name</li>
                <li>Email Address</li>
                <li>Phone Number</li>
                <li>Delivery Address</li>
                <li>Payment Information</li>
            </ul>

            <h4>How We Use Your Information</h4>

            <ul>
                <li>Process orders</li>
                <li>Customer support</li>
                <li>Delivery</li>
                <li>Improve our services</li>
            </ul>

            <h4>Security</h4>

            <p>
                We use reasonable security measures to protect your information.
            </p>

            <h4>Contact Us</h4>

            <p>
                If you have any questions regarding this Privacy Policy,
                please contact our support team.
            </p>

        </div>
    </div>
</div>

@endsection