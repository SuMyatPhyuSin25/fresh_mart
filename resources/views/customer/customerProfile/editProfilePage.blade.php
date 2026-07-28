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
    <form action="{{ route('profile#update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card shadow-sm">
            <div class="card-body">

                <div class="row g-4">

                    <!-- Profile Image Section -->
                    <div class="col-12 col-md-4 col-lg-3 text-center">

                        <img
                            src="{{ Auth::check() && Auth::user()->profile
                                ? asset('profile/' . Auth::user()->profile)
                                : asset('img/default-img.jpg') }}"
                            alt="Profile Image"
                            class="img-fluid img-thumbnail mb-3"
                            id="output"
                            style="max-width: 250px;">

                        <input
                            type="file"
                            name="image"
                            class="form-control @error('image') is-invalid @enderror"
                            accept="image/*"
                            onchange="document.getElementById('output').src=window.URL.createObjectURL(this.files[0])">

                        @error('image')
                            <small class="invalid-feedback d-block">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <!-- Form Section -->
                    <div class="col-12 col-md-8 col-lg-9">

                        <!-- Name & Email -->
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>

                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', Auth()->user()->name ?? Auth()->user()->nickname) }}"
                                        placeholder="Name...">

                                    @error('name')
                                        <small class="invalid-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>

                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', Auth()->user()->email) }}"
                                        placeholder="Email...">

                                    @error('email')
                                        <small class="invalid-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Phone & Address -->
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>

                                    <input
                                        type="text"
                                        name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone', Auth()->user()->phone) }}"
                                        placeholder="09xxxxxxx">

                                    @error('phone')
                                        <small class="invalid-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Address</label>

                                    <input
                                        type="text"
                                        name="address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        value="{{ old('address', Auth()->user()->address) }}"
                                        placeholder="Enter your address...">

                                    @error('address')
                                        <small class="invalid-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Change Password -->
                        <div class="mb-3">
                            <a href="{{route('change#CustomerPassword')}}">
                                Change Password
                            </a>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-10 w-md-auto">
                            Update Profile
                        </button>

                    </div>
                </div>

            </div>
        </div>
    </form>
</div>



@endsection