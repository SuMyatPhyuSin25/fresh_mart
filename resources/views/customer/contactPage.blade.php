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


        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Contact</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
             
                <li class="breadcrumb-item active text-white">Contact</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Contact Start -->
        <div class="container-fluid contact py-5">
            <div class="container py-5">
                <div class="p-5 bg-light rounded">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="text-center mx-auto" style="max-width: 700px;">
                                <h1 class="text-primary">Get in touch</h1>
                                
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="h-100 rounded">
                               
                        <iframe
    src="https://www.google.com/maps?q=Yangon%2C%20Myanmar&output=embed"
    width="100%"
    height="300"
    style="border:0;"
    allowfullscreen=""
    loading="lazy">
</iframe>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <form action="{{route('contact.store')}}" class="" method="post">
                                @csrf
                                <input type="text" value="{{Auth::user()->name}}" class="w-100 form-control border-0 py-3 mb-4" placeholder="Your Name" >
                                <input type="email" value="{{Auth::user()->email}}" class="w-100 form-control border-0 py-3 mb-4" placeholder="Enter Your Email">
                                <textarea class="w-100 form-control border-0 mb-4" rows="5" cols="10" placeholder="Your Message" name="user_message" @error('user_message') is-invalid @enderror" ></textarea>
                                    @error('user_message')
                                    <p class='invalid invalid-feedback'>{{ $message}}</p>
                                    @enderror

                                <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary " type="submit">Submit</button>
                            </form>


                        </div>
                        <div class="col-lg-5">
                            <div class="d-flex p-4 rounded mb-4 bg-white">
                                <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Address</h4>
                                    <p class="mb-2">Downtown, Yangon, Myanmar</p>
                                </div>
                            </div>
                            <div class="d-flex p-4 rounded mb-4 bg-white">
                                <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Mail Us</h4>
                                    <p class="mb-2">freshmartsupport12@gmail.com</p>
                                </div>
                            </div>
                            <div class="d-flex p-4 rounded bg-white">
                                <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Telephone</h4>
                                    <p class="mb-2">(+012) 3456 7890</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->







@endsection