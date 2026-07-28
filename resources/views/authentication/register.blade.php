@extends('authentication.layouts.master');


@section('content')
<div class="container bg-white" style="background: rgba(1,0,1,0.1); opacity:0.9">

    <div class="card border-0  my-5" >
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">

                <div class="col-lg-8 offset-2">
                    <div class="p-5">
                        <div class="text-center ">
                            <h1 class="h2 text-success mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" method="POST" action="{{route('register')}}">

                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="fs-6 form-control form-control-user @error('name') is-invalid @enderror" id="exampleFirstName"
                                        placeholder="Enter Name..." name="name" value="{{old('name')}}">

                                    @error('name')
                                    <span class="invalid invalid-feedback fs-6">{{ $message }}</span>

                                    @enderror

                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="fs-6 form-control form-control-user @error('phone') is-invalid @enderror" id="exampleLastName"
                                        placeholder="Phone Number..." name="phone" value="{{old('phone')}}">

                                    @error('phone')
                                    <span class="invalid invalid-feedback fs-6">{{ $message }}</span>

                                    @enderror


                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="fs-6 form-control form-control-user @error('email') is-invalid @enderror" id="exampleInputEmail"
                                    placeholder="Email Address" name="email" value="{{old('email')}}">
                                @error('email')
                                <span class=" invalid invalid-feedback fs-6">{{ $message }}</span>


                                @enderror


                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="fs-6 form-control form-control-user @error('password') is-invalid  @enderror"
                                        id="exampleInputPassword" placeholder="Password" name="password">

                                         @error('password')
                                            <span class="invalid invalid-feedback fs-6">{{ $message }}</span>


                                            @enderror


                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="fs-6 form-control form-control-user @error('password_confirmation') 
                                    is-invalid
                                    @enderror"
                                        id="exampleRepeatPassword" placeholder="Confirm Password"
                                        name="password_confirmation">
                                        
                                         @error('password_confirmation')
                                            <span class="invalid invalid-feedback fs-6">{{ $message }}</span>

                                            @enderror

                                </div>
                            </div>
                            <button type="submit" class="fs-6 btn btn-success btn-user btn-block font-bold text-lg">
                                Register Account
                            </button>
                        </form>
                        <hr>

                        <div class="text-center ">
                         
                            <a class="fs-6 small text-success text-lg" href="{{route('login')}}">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection