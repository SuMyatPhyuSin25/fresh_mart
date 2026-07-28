@extends('admin.layouts.master');

@section('content')


<div class="container-fluid">


<!-- DataTales Example -->
<div class="card shadow mb-4 col">
    <div class="card-header py-3">
        <h1 class="h3 mb-3 text-gray-800 text-center">Edit Profile</h1>
        <div class="">
            <div class="">
                <h6 class="m-0 font-weight-bold text-primary">Admin Profile ( <span
                        class="text-danger"> {{Auth()->user()->role}}</span> ) </h6>
            </div>
        </div>
    </div>
    <form action="{{route('update#profile')}}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-3">

                 
                         <img src="{{Auth::check() && Auth::user()->profile ? asset('profile/' . Auth::user()->profile) : asset('img/default-img.jpg')}}" alt="" class="img-profile img-thumbnail" id="output">


                    <input type="file" name="image" id="" class="form-control mt-1 @error('image') is-invalid  @enderror" onchange="document.getElementById('output').src=window.URL.createObjectURL(this.files[0])" accept="image/*">

                    @error('image')
                    <small class="invalid invalid-feedback">{{$messages}}</small>

                    @enderror

                
                </div>
                <div class="col">

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">
                                    Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid   @enderror"
                                    placeholder="Name..."  value="{{old('name', Auth()->user()->name != null ? Auth()->user()->name : Auth()->user()->nickname )}}" >
                                    @error('name')
                                    <small class="invalid invalid-feedback">{{$message}}</small>
                                    @enderror

                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">
                                    Email</label>
                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror "  value="{{old('email',Auth()->user()->email)}}"
                                    placeholder="Email...">
                                       @error('email')
                                    <small class="invalid invalid-feedback">{{$message}}</small>
                                    @enderror


                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">
                                    Phone</label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"  value="{{old('phone',Auth()->user()->phone )}}"
                                    placeholder="09xxxxxx">

                                    @error('phone')
                                    <small class="invalid invalid-feedback">{{$message}}</small>

                                    @enderror

                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">
                                    Address</label>
                                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{old('address', Auth::user()->address)}}"
                                    placeholder="Address">

                                    @error('address')
                                    <small class="invalid-feedback text-danger">{{$message}}</small> 
                                    @enderror

                            </div>
                        </div>
                    </div>
                    <div class='my-2'>
                        
                       <a href="{{route('profile#changePassword')}}">Change Password</a>
                    </div>

                    <input type="submit" value="Update Profile" class="btn btn-primary mt-3">
                </div>
            </div>
        </div>
    </form>
</div>

</div>

@endsection