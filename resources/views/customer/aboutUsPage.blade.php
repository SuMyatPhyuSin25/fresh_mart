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

            
    <section class="py-5">
    <div class="container">

        <!-- Title -->
        <div class="text-center mb-5">
            <h1 class="fw-bold" style="color:#81C408">About Fresh Mart</h1>
            <p class="text-muted">Fresh Fruits & Vegetables Delivered Daily</p>
        </div>

        <!-- About Section -->
        <div class="row align-items-center mb-5">

            <div class="col-lg-6 mb-3">
                <img src="{{asset('img/about-us.png')}}"
                     class="img-fluid rounded shadow"
                     alt="Fresh Mart Store">
            </div>

            <div class="col-lg-6">
                <h2 class="fw-bold mb-3">Who We Are</h2>

                <p>
                    Welcome to <strong>Fresh Mart</strong>, your trusted fruit and vegetable store.
                    We are committed to providing fresh, healthy, and high-quality produce
                    directly sourced from local farms and trusted suppliers.
                </p>

                <p>
                    Our goal is to promote healthy living by making fresh food accessible,
                    affordable, and convenient for everyone.
                </p>

                <p>
                    From daily essentials to seasonal fruits, Fresh Mart ensures freshness
                    in every bite.
                </p>
            </div>

        </div>

        <!-- Features -->
        <div class="row text-center g-4 mb-5">

            <div class="col-md-4">
                <div class="p-4 shadow-sm rounded bg-light h-100">
                    <h3>🍎</h3>
                    <h5 class="fw-bold">Fresh Products</h5>
                    <p>We deliver fresh fruits and vegetables every day.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4 shadow-sm rounded bg-light h-100">
                    <h3>🚚</h3>
                    <h5 class="fw-bold">Fast Delivery</h5>
                    <p>Quick and safe delivery to your doorstep.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4 shadow-sm rounded bg-light h-100">
                    <h3>💚</h3>
                    <h5 class="fw-bold">Healthy Living</h5>
                    <p>Helping you maintain a healthy lifestyle every day.</p>
                </div>
            </div>

        </div>

        <!-- Mission -->
        <div class="text-muted text-center p-5 rounded mb-5">
            <h2 class="fw-bold">Our Mission</h2>
            <p class="mb-0">
  At Fresh Mart, our mission is to make fresh, healthy, and nutritious food
                accessible to everyone at affordable prices. We aim to build a healthier
                community by encouraging people to choose natural and chemical-free produce.
                We are committed to reducing food waste by sourcing responsibly and
                delivering efficiently. We believe in supporting local farmers, promoting
                sustainability, and ensuring that every household can enjoy farm-fresh
                fruits and vegetables every day.
            </p>
        </div>

        <!-- Contact + Map -->
        <div class="row g-4">

            <!-- Contact Info -->
            <div class="col-lg-5">
                <div class="p-4 shadow-sm rounded bg-light h-100">
                    <h4 class="fw-bold mb-3">Contact Us</h4>

                    <p><strong>📍 Address:</strong> Downtown, Yangon, Myanmar</p>
                    <p><strong>📞 Phone:</strong> +95 9123456789</p>
                    <p><strong>📧 Email:</strong> support@freshmart.com</p>
                    <p><strong>🕒 Open:</strong> 8:00 AM - 8:00 PM</p>
                </div>
            </div>

            <!-- Google Map -->
            <div class="col-lg-7">
                <div class="rounded overflow-hidden shadow-sm">

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

        </div>

    </div>
</section>


@endsection