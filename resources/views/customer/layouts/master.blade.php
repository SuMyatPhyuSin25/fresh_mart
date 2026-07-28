<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fresh Mart - Fruits and Vegetable </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <!-- <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet"> -->
     <link href="{{asset('customer/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('customer/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('customer/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('customer/css/style.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="css/custom.css">

   
    <!-- custom css  -->
     <link rel="stylesheet" href="{{asset('customer/css/custom.css')}}">

    
  <style>
       .pagination{
        display: flex !important;
    flex-direction: row !important;
    list-style-type: none;
    width:100%;
    justify-content: center;
    align-items:center;
   
       }

       .pagination span{

     width: 44px;
    height: 44px;


       }
  </style>
    

</head>

<body>
<!-- Spinner Start  -->
         <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div> 
         <!-- Spinner End -->






      <!-- Navbar start -->
        <div class="container-fluid" > 
            <div class="container top-bar bg-primary d-none d-lg-block">
                <div class="d-flex justify-content-between">
                    <div class="top-info ps-2">
                        <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">Downtown, Yangon, Myanmar</a></small>
                        <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">freshmartsupport12@gmail.com</a></small>
                    </div>
                    <div class="top-link pe-2">
                        <a href="{{route('privacy')}}" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                        <a href="{{route('terms')}}" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                        <a href="{{route('returns')}}" class="text-white"><small class="text-white ms-2">Returns Policy</small></a>
                    </div>
                </div>
            </div>

            <div class="container">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="index.html" class="navbar-brand"><h1 class="text-primary display-6">Fresh Mart</h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="{{route('customerHome')}}" class="nav-item nav-link" @if(request()->routeIs('customerHome')) active @endif>Home</a>
                            <a href="{{route('shop#Page')}}" class="nav-item nav-link" @if(request()->routeIs('shop#Page')) active @endif>Shop</a>
                            <a href="{{route('aboutUs')}}" class="nav-item nav-link">About us</a>
                               <a href="{{route('customer.Cart')}}" class="nav-item nav-link">Cart</a>
                             
                            {{-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                    <a href="{{route('customer.Cart')}}" class="dropdown-item">Cart</a>

                                    <a href="{{route('paymentPage')}}" class="dropdown-item">Checkout</a>
                                   
                                </div>
                            </div> --}}
                            <a href="{{route('contact')}}" class="nav-item nav-link">Contact</a>
                        </div>

                        <div class="d-flex m-3 me-0">
                            <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4 mt-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                            <a href="{{route('orderList')}}" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                                {{-- <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span> --}}
                            </a>
                            <div href="#" class="nav-item dropdown">
                                {{-- <i class="fas fa-user fa-2x"></i> --}}
                                  
                            <a href="#" class="nav-link dropdown-toggle my-auto mt-2" data-bs-toggle="dropdown">
                                <img src="{{asset(Auth::user()->profile==null ? 'img/image.png' : 'profile/'.Auth::user()->profile)}}" style="width: 50px" class="img-profile  rounded-circle" alt="">
                                <span>{{Auth::user()->name ==null ? Auth::user()->nickname : Auth::user()->name}}</span>
                            </a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="{{route('edit#CustomerProfile')}}" class="dropdown-item my-2">Edit Profile</a>
                                <a href="{{route('change#CustomerPassword')}}" class="dropdown-item my-2">Change Password</a>
                                <a href="#" class="dropdown-item my-2">
                                    <form action="{{route('logout')}}" method="post">
                                        @csrf

                                        <input type="submit" value="Logout"
                                            class="btn btn-outline-success rounded w-100 mb-3">
                                    </form>
                                </a>
                            
                        </div>
                    </div>


                            </div>
                               

                        

                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->



         


      
     @include('sweetalert::alert')

            @yield('content')
            
    
        <!-- Footer Start -->
         <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
            <div class="container py-5">
                <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <a href="#">
                                <h1 class="text-primary mb-0">Fresh Mart</h1>
                                <p class="text-secondary mb-0">Fresh products</p>
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <div class="position-relative mx-auto">
                                <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number" placeholder="Your Email">
                                <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="d-flex justify-content-end pt-3">
                                <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                                <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row g-5 d-flex justify-content-between">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="text-light mb-3">Why People Like us!</h4>
                            <p class="mb-4"> Offering reliable and trustworthy service  and a wide range of fresh products. Safe reliable service and  supporting for healthy living</p>
                            <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Read More</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="d-flex flex-column text-start footer-item">
                            <h4 class="text-light mb-3">Shop Info</h4>
                            <a class="btn-link" href="{{route('aboutUs')}}">About Us</a>
                            <a class="btn-link" href="{{route('contact')}}">Contact Us</a>
                            <a class="btn-link" href="{{route('privacy')}}">Privacy Policy</a>
                            <a class="btn-link" href="{{route('terms')}}">Terms & Condition</a>
                            <a class="btn-link" href="{{route('returns')}}">Return Policy</a>
                            <a class="btn-link" href="{{route('faq')}}">FAQs & Help</a>
                        </div>
                    </div>
                 
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="text-light mb-3">Contact</h4>
                            <p>Address: Downtown, Yangon</p>
                            <p>Email: freshmartsupport12@gmail.com</p>
                            <p>Phone: +0123 4567 8910</p>
                            <p>Payment Accepted</p>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <!-- Footer End -->
@if(!request()->cookie('cookie_accepted') && !request()->cookie('cookie_rejected'))
<div id="cookie-banner"
     class=" position-fixed bottom-0 start-0 end-0 bg-dark text-white p-3 shadow"
     style="z-index:9999; " style="background-color:#81C408">
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            We use cookies to improve your experience on our website.
        </div>

       <div class="d-flex justify-content-end gap-2">
         <button class="btn btn-success" id="accept-cookie">
            Accept
        </button>
          <button class="btn btn-danger" id="reject-cookie">
            Reject
        </button>
       </div>
    </div>
</div>
@endif
       
    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i> Fresh Mart</a>, All right reserved.</span>
                </div>
                {{-- <div class="col-md-6 my-auto text-center text-md-end text-white">
                   
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a
                        class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Copyright End -->



        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
    <!-- JavaScript Libraries -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('customer/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('customer/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('customer/lib/lightbox/js/lightbox.min.js')}}"></script>
    <script src="{{asset('customer/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Template Javascript -->
<script src="{{asset('customer/js/main.js')}}"></script> 


  <!-- sweet-alert cdn -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   

    <script src="sweetalert2.all.min.js"></script>

    <script>
      
    </script>


   </body> 

   @yield('js-content')

   
  <script>
document.getElementById('accept-cookie')?.addEventListener('click', function () {

    fetch("{{ route('cookie.accept') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json"
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('cookie-banner').remove();
    });

});



</script>
</html> 
