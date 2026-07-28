
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Fresh Mart - Fruits and Vegetables </title>

    <!-- Custom fonts !-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
         
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   
    <link href="{{asset('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   
   <style>
     .sidebar {
    position: fixed;     /* FIXED TO TOP */
    top: 0;
    left: 0;
    width: 250px;
    height: 100vh;       /* FULL HEIGHT */
    overflow-y: auto;    /* Scroll if menu is long */
    z-index: 1000;
}

.main-content {
    margin-left: 250px;  /* SAME AS SIDEBAR WIDTH */
    min-height: 100vh;
    background: #f8f9fc;
    padding: 20px;
}

   </style>

  
    @include('sweetalert::alert')

</head>

<body id="page-top" >

    <!-- Page Wrapper -->
    <div id="wrapper" >

        <!-- Sidebar -->
      
        <!-- Sidebar -->
<div class="d-flex">
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion " id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex flex-column  align-items-center justify-content-center " href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-2 text-center mt-1">Fresh Mart</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-2">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="{{route('admin#dashboard')}}">
            <i class="fas fa-fw fa-table me-2 text-white fs-6"></i><span class="text-white fs-6">Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="{{route('category#list')}}">
            <i class="fa-solid fa-circle-plus me-2 text-white fs-6"></i><span class="text-white fs-6">Category</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="{{route('product#add')}}">
            <i class="fa-solid fa-plus me-2 text-white fs-6"></i><span class="text-white fs-6">Add Products</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="{{route('product#list')}}">
            <i class="fa-solid fa-layer-group me-2 text-white fs-6"></i><span class="text-white fs-6">Product List</span>
        </a>
    </li>

   
    
    @if(Auth::user()->role=='superadmin')

     <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="{{route('payment#create')}}">
             <i class="fa-solid fa-plus me-2 text-white fs-6"></i><span class="text-white fs-6">Add Payment Method</span>
        </a>
    </li>

       <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="{{route('payment#list')}}">
           <i class="fa-solid fa-credit-card me-2 text-white fs-6">
                </i>  <span class="text-white fs-6">Payment Method List</span>
           
        </a>
    </li>
    @endif
   
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="{{route('saleInfo')}}">
            <i class="fa-solid fa-list me-2 text-white fs-6"></i><span class="text-white fs-6">Sale Information</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="{{route('order#List')}}">
            <i class="fa-solid fa-cart-shopping me-2 text-white fs-6"></i><span class="text-white fs-6">Order Board</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="{{route('viewUserMessage')}}">
            <i class="fa-solid fa-message me-2 text-white fs-6"></i><span class="text-white fs-6">User Message</span>
        </a>

    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="{{route('profile#changePassword')}}">
            <i class="fa-solid fa-lock me-2 text-white fs-6"></i><span class="text-white fs-6">Change Password</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-2">

    <!-- Logout -->
    <li class="nav-item">
        <form action="{{route('logout')}}" method="POST" class="m-2">
            @csrf
            <button type="submit" class="btn btn-danger w-100">
                <i class="fa-solid fa-right-from-bracket me-2"></i>Logout
            </button>
        </form>
    </li>

</ul>

</div>
        <!-- End of side bar -->


       



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white top-bar mb-4 static-top shadow">



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                          @auth
    <span class="mr-2  d-none d-lg-inline text-gray-600 large fs-6 ">
        {{ \Illuminate\Support\Facades\Auth::user()->name ?? \Illuminate\Support\Facades\Auth::user()->nickname }}
    </span>
@endauth


                                <img class="rounded-circle img-profile img-thumbnail "   style="width: 50px; height: 50px; object-fit: cover;" src="{{ Auth::user()->profile==null ? asset('img/image.png') : asset('/profile/' . Auth::user()->profile)}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow "
                                aria-labelledby="userDropdown">
                                
                                <a class="dropdown-item" href="{{route('edit#profile')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                   Edit Profile
                                </a>

                               
                             

                                @if(Auth::user()->role== 'superadmin')
                                       <a class="dropdown-item" href="{{route('add#newAdmin')}}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Add New Admin Account
                                </a>
                                <a class="dropdown-item" href="{{route('account#adminList')}}">
                                    <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Admin List
                                </a>

                                <a class="dropdown-item" href="{{route('user#list')}}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    User List
                                </a>
                                @endif
                                      

                                <a class="dropdown-item" href="{{route('profile#changePassword')}}">
                                    <i class="fa-solid fa-lock fa-sm fa-fw mr-2 text-gray-400"></i></i></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <span class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                    <form action="{{ route('logout')}}" method="POST">
                                        @csrf
                                      
                                        <input type="submit" class="btn btn-dark text-white w-100 " value="Logout">
                                    </form>
                                </span>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

        

                <!-- Here ................. -->

                <div class="flex-grow-1 main-content">
                    @yield('content')

                     
                </div>

              

              @include('sweetalert::alert')


                <!-- Bootstrap core JavaScript-->
                <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
                    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
                    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

                <!-- Core plugin JavaScript-->
                <script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                   {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}


             
               
                {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
                

             

               


</body>

@yield('script-content')

</html>

