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
                      <form action="{{route('shop#Page')}}" method="get" class="input-group w-75 mx-auto d-flex">
                          <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1" name="searchKey" value={{request('searchKey')}}>
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->


        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Product Detail</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
               
                <li class="breadcrumb-item active text-white">Product Detail</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Single Product Start -->
        <div class="container-fluid py-5 mt-5">
            <div class="container py-5">
                <div class="row g-4 mb-5">
                    <div class="col-lg-8 col-xl-9">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class=" rounded w-200px h-200px">
                                    <a href="#">
                                        <img src="{{asset('productImage/'.$productDetail->image)}}" class="img-fluid rounded" alt="Image">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h4 class="fw-bold mb-3">{{$productDetail->name}}</h4>
                                <p class="mb-3">Category:{{$productDetail->category_name}}</p>
                                <h5 class="fw-bold mb-3">{{$productDetail->price}} MMK/kg</h5>
                                <div class="d-flex mb-4">

                                    <span>
                                        @for ($i = 1; $i <= $ratingFormat; $i++)
                                        <i class="fa-solid fa-star text-warning"></i>
                                            
                                        @endfor

                                        @for($j=$ratingFormat+1; $j<=5; $j++)
                                         <i class="fa-regular fa-star text-warning"></i>

                                        @endfor
                                    </span>
                                </div>
                                <p class="mb-4 text-success">{{$productDetail->stock}} items left!</p>
                                
                               <form action="{{route('add.Cart')}}" method="post">
                                @csrf
                                 <input type="hidden" name="userId" value="{{Auth::user()->id}}">

                                <input type="hidden" name="product" value="{{$productDetail->product_id}}">

                                 <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="qty" class="form-control form-control-sm text-center border-0" value="1">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="submit" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>

                                   <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i
                                        class="fa-solid fa-star me-2 text-secondary"></i> Rate this product</button>
                               </form>




                            </div>


                            

                              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Rate this product
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                         <form action="{{route('post.Rating')}}" method="post">
                                            @csrf

                                            <div class="modal-body">

                                                <input type="hidden" name="product_id" value="{{$productDetail->product_id}}">

                                                <div class="rating-css">
                                                    <div class="star-icon">
                                                        
                                                        @if($userRating==0)
                                                        <input type="radio" value="1" name="productRating" id="rating1" checked>
                                                        <label for="rating1" class="fa fa-star"></label>

                                                        <input type="radio" value="2" name="productRating" id="rating2">
                                                        <label for="rating2" class="fa fa-star"></label>
                                                        
                                                        <input type="radio" value="3" name="productRating" id="rating3">
                                                        <label for="rating3" class="fa fa-star"></label>

                                                        <input type="radio" value="4" name="productRating" id="rating4">
                                                        <label for="rating4" class="fa fa-star"></label>

                                                        <input type="radio" value="5" name="productRating" id="rating5">
                                                        <label for="rating5" class="fa fa-star"></label>

                                                        @else

                                                      
                                                        @for($k=1;$k<=$userRating;$k++)

                                                         <input type="radio" value="{{$k}}" name="productRating" id="rating{{$k}}" checked>
                                                        <label for="rating{{$k}}" class="fa fa-star"></label>
                                                        @endfor

                                                          @for($j=$userRating+1; $j<=5; $j++)
                                                            <input type="radio" value="{{$j}}" name="productRating" id="rating{{$j}}">
                                                        <label for="rating{{$j}}" class="fa fa-star"></label>
                                         
                                                          @endfor

                                                        @endif
                                                  

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Rating</button>
                                            </div>
                                        </form> 

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <nav>
                                    <div class="nav nav-tabs mb-3">
                                        <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                            id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                            aria-controls="nav-about" aria-selected="true">Description</button>
                                        <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                            id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                            aria-controls="nav-mission" aria-selected="false">Reviews <span
                                            class=" btn btn-sm btn-secondary rounted shadow-sm">{{count($comments)}}</span></button>
                                    </div>
                                </nav>
                                <div class="tab-content mb-5">
                                    <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                        <p>{{$productDetail->description}}</p>
                                        <div class="px-2">
                                            <div class="row g-4">
                                                <div class="col-6">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                        @foreach($comments as $comment)
                                        <div class="d-flex">
                                            <img src="{{asset($comment->profile == null ? 'img/image.png' : 'profile/' . $comment->profile)}}" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                            <div class="">
                                                <p class="mb-2" style="font-size: 14px;">{{$comment->created_at->format('j-F-Y')}}</p>
                                                <div class="d-flex justify-content-between gap-5">
                                                    <h6 class="fw-bold">{{$comment->name}}</h6>
                                                  
                                                    @if($comment->user_id == Auth::id())
                                                     <button type="button"
                                                onclick="deleteComment({{$comment->comment_id}})"
                                                class="btn btn-sm btn-danger" style="font-size: 10px; padding: 5px 10px;">
                                                
                                                Delete
                                                </button>

                                                    @endif

                                                     
                                                </div>
                                                <p class="text-muted">{{$comment->message}}</p>
                                            </div>
                                        </div>
                                        @endforeach

                                        
                                    </div>
                                    <div class="tab-pane" id="nav-vision" role="tabpanel">
                                        <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                                            amet diam et eos labore. 3</p>
                                        <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                                            Clita erat ipsum et lorem et sit</p>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('post.Comment') }}" method="post">
                                @csrf
                                 <input type="hidden" name="productId" value="{{$productDetail->product_id}}">
                                <h4 class="mb-3 fw-bold">Leave a comment</h4>
                                <div class="row g-4">
                                    
                                    <div class="col-lg-12">
                                        
                                      
                                      
                                        
                                         
                                         <div class="border-bottom rounded my-4">

                                            <textarea name="comment" id="" class="form-control border-0" cols="30" rows="8" placeholder="Your Comment *" ></textarea>
                                        </div>
                                           <button type="submit" class="btn border border-secondary text-primary rounded-pill px-4 py-3"> Post Comment</button>
                                       
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                    


                </div>
                <h1 class="fw-bold mb-0">Related products</h1>
                <div class="vesitable">
                      
                    <div class="owl-carousel vegetable-carousel justify-content-center">

                      @foreach($productLists as $productList)
                     
                                            <div class="rounded position-relative vesitable-item">
                                                <div class="vesitable-img">
                                                   <a href="{{route('product.Detail', $productList->product_id)}}"> <img src="{{ asset('productImage/' . $productList->image) }}" class="img-fluid w-100 rounded-top" alt="" style="height: 250px"></a>
                                                </div>
                                                 <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">{{$productList->category_name}}</div>
                                              
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>{{ $productList->name }}</h4>
                                                   
                                                  {{-- <p>{{Str::words($productList->description, 10, '...')}}</p> --}}
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">{{$productList->price}} MMK </p>
                                                   
                                                    </div>
                                                </div>
                                            </div>
                                       
                        @endforeach

                       


                    </div>
                </div>
            </div>
        </div>
        <!-- Single Product End -->
@endsection


@section('js-content')
<script>
    const deleteComment = (id) => {

        Swal.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire("Deleted!", "Comment has been deleted.", "success");

    setTimeout(() => {
  
        window.location.href = `/customer/comment/delete/` + `${id}`;

    }, 800);
  }
});
    }
</script>


@endsection