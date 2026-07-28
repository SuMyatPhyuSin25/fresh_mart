@extends('customer.layouts.master');
@section('content')

  <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        {{-- <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5> --}}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">

                     <form action="{{route('shop#Page')}}" method="get" class="input-group w-75 mx-auto d-flex">
                       <div class="input-group w-75 mx-auto d-flex">

                            <input type="search" class="form-control p-3" placeholder="Search your fruit..." aria-describedby="search-icon-1" value="{{request('searchKey')}}" name="searchKey">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div></form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->
        
 <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="">
                        <div class="row">
                            <div class="col-8 offset-2">

                                <div class="card">
                                    <div class="card-body shadow">
                                        <form action="{{route('update#CustomerPassword')}}" method="post" class="p-3 rounded">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Old Password</label>
                                                <input type="password" name="oldPassword" class="form-control  @error('oldPassword') is-invalid @enderror"
                                                    placeholder="Enter Old Password...">
                                                    @error('oldPassword')
                                                    <small class="text-danger invalid invalid-feedback">{{$message}}</small>

                                                    @enderror

                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-bold">New Password</label>
                                                <input type="password" name="newPassword" class="form-control  @error('newPassword') is-invalid  @enderror "
                                                    placeholder="Enter New Password...">
                                                     @error('newPassword')
                                                    <small class="text-danger invalid invalid-feedback">{{$message}}</small>

                                                    @enderror

                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Confirm Password</label>
                                                <input type="password" name="confirmPassword" class="form-control @error('confirmPassword') is-invalid  @enderror"
                                                    placeholder="Enter Confirm Password..." >
                                                     @error('confirmPassword')
                                                    <small class="text-danger invalid invalid-feedback">{{$message}}</small>

                                                    @enderror

                                            </div>
                                            <div class="">
                                                <input type="submit" value="Change" class="btn bg-dark text-white">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>



@endsection