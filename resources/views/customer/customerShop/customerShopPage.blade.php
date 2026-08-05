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
        </div>
        <!-- Modal Search End -->


        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Shop</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                
                <li class="breadcrumb-item active text-white">Shop</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Fruits Shop Start-->
        <div class="container-fluid fruit py-5">
            <div class="container py-5">
                <h1 class="mb-4">Fresh fruits shop</h1>
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-4">
                            <div class="col-xl-3">
                                 <form action="{{route('shop#Page')}}" method="GET" class="w-100 input-group mx-auto">
                              @csrf
                                <div class="input-group w-100 mx-auto d-flex">
                                    <input type="search" name="searchKey" value="{{request('searchKey')}}" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            
                            <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                              
                                </div>
                            </form>
                            </div>
                            <div class="col-6"></div>
                            <div class="col-xl-3">
                                <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                    <label for="fruits">Default Sorting:</label>
                                    <form action="{{route('shop#Page', )}}" method="GET" >
                                        <select id="fruits" name="category" class="border-0 form-select-sm bg-light me-3"onchange="this.form.submit()">
                                            <option value="" @selected(!request('category'))>All products</option>
                                        @foreach($categories as $category)
                                            {{-- <option value="">All products</option> --}}
                                           <option value="{{ $category->name }}" @selected(request('category') == $category->name)>
    {{ $category->name }}
</option>
                                        @endforeach
                                    </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-3">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                      
                                        <div class="mb-3">
                                            <h4>Categories</h4>
                                            <ul class="list-unstyled fruite-categorie">
                                                @foreach($categoriesWithCount as $category)
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="{{ route('shop#Page') }}?category={{ $category->name }}"><i class="fas fa-apple-alt me-2"></i>{{ $category->name }}</a>
                                                        <span>({{ $category->products_count }})</span>
                                                    </div>
                                                </li>
                                                @endforeach
                                               
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                              <form action="{{route('shop#Page')}}" method="get">
                                            @csrf

                                            <select name="sortingType" class="form-control w-100 bg-white mt-3">
                                                <option value="name,asc" @if(request('sortingType')=="name,asc") selected @endif>Alpha: A-Z</option>
                                                <option value="name,desc" @if(request('sortingType')=="name,desc") selected  @endif>Alpha: Z-A</option>
                                                <option value="price,asc" @if(request('sortingType')=="price,asc") selected @endif>Price: Low-High</option>
                                                <option value="price,desc" @if(request('sortingType')=="price,desc") selected  @endif>Price: High-Low</option>
                                            
                                            </select>

                                            <input type="submit" value="Sort" class=" btn btn-success my-3 w-100">
                                        </form>
                                        </div>


                                    
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                             <form action="{{route('shop#Page')}}" method="get">
                                            @csrf

                                            <input type="text" name="minPrice" value="{{request('minPrice')}}" placeholder="Minimum Price..."
                                                class=" form-control my-2">
                                            <input type="text" name="maxPrice" value="{{request('maxPrice')}}" placeholder="Maximum Price..."
                                                class=" form-control my-2">
                                            <input type="submit" value="Search" class=" btn btn-success my-2 w-100">
                                        </form>
                                         <a href="{{route('shop#Page')}}"><input type="button" value="Clear filter" class=" btn btn-success my-2 w-100">
                                        </form></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <h4 class="mb-3">Featured products</h4>
                                        <div class="d-flex align-items-center justify-content-start">
                                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                                <img src="img/featur-1.jpg" class="img-fluid rounded" alt="">
                                            </div>
                                            <div>
                                                <h6 class="mb-2">Big Apple</h6>
                                                <div class="d-flex mb-2">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <h5 class="fw-bold me-2">5000 MMK</h5>
                                                    <h5 class="text-danger text-decoration-line-through">6000 MMK</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-start">
                                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                                <img src="img/featur-2.jpg" class="img-fluid rounded" alt="">
                                            </div>
                                            <div>
                                                <h6 class="mb-2">Big Strawberry</h6>
                                                <div class="d-flex mb-2">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <h5 class="fw-bold me-2">5000 MMK</h5>
                                                    <h5 class="text-danger text-decoration-line-through">6000 MMK </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-start">
                                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                                <img src="img/featur-3.jpg" class="img-fluid rounded" alt="">
                                            </div>
                                            <div>
                                                <h6 class="mb-2">Big Broccoli</h6>
                                                <div class="d-flex mb-2">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <h5 class="fw-bold me-2">6000 MMK</h5>
                                                    <h5 class="text-danger text-decoration-line-through">7000 MMK</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center my-4">
                                            <a href="#" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew More</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="position-relative">
                                            <img src="img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                                            <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                                <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-9">
                                <div class="row g-4 justify-content-center">

                                     @if(count($products)> 0)
                                        @foreach($products as $item)
                                        <div class="col-md-6 col-lg-6 col-xl-4">
                                            <div class="rounded position-relative fruit-item">
                                                <div class="fruit-img">
                                                 <a href="{{ route('product.Detail', $item->id) }}">   <img src="{{ asset('productImage/' . $item->image) }}" class="img-fluid w-100 rounded-top" alt="" style="height: 250px"></a>
                                                </div>
                                                 <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">{{$item->category_name}}</div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{$item->category_name}}</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>{{ $item->name }}</h4>
                                                   
                                                  {{-- <p>{{Str::words($item->description, 10, '...')}}</p> --}}
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">{{$item->price}} MMK</p>
                                                        {{-- <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a> --}}
                                                        <a></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    

                                        @endforeach

                                       
                            
                                        @else
                                        <div class="text-center">
                                          <h1 class="text-success">No product found</h1>

                                        </div>
                                
                                            
                                        @endif
                                          <div class=" d-flex flex-row pagination my-5 w-100">
                                             <span class="d-flex flex-row">{{$products->links()}}</span>
                                         </div>

                                  
                                </div>
                                   

                            </div>
                                
                              
                              


                        </div>
                    </div>
                
                </div>
            </div>
        </div>
        <!-- Fruits Shop End-->
         

@endsection