@extends('authentication.layouts.master');

@section('content')


    <div class="container bg-white" style="background: rgba(1,0,1,0.1); opacity:0.9">

        <!-- Outer Row -->
          <div class=" border-0  my-5" >

           <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9"  >

                <div class=" o-hidden border-0  my-5">
                    <div class="card-body p-0"  >
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-8 offset-2">
                              
                                    <div class="text-center " >
                                        <h1 class=" bg-white mb-4 h1" style="opacity:0.9;color:#81C408">Welcome from Fresh Mart!</h1>
                                       

                                      
                                    </div>
                                    <form class="user" method="POST" action="{{route('login')}}">

                                            @csrf

                                        <div class="form-group">
                                            <input type="email" class="fs-6 form-control form-control-user @error('email') is-invalid @enderror"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name="email" value="{{old('email')}}">
                                                @error('email')

                                                <div class='invalid invalid-feedback'>{{ $message }}</div>

                                                @enderror

                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="fs-6 form-control form-control-user @error('password') is-invalid @enderror"
                                                id="exampleInputPassword" placeholder="Password" name="password"
                                                value="">
                                                 @error('password')

                                                <div class='invalid invalid-feedback'>{{ $message }}</div>

                                                @enderror


                                        </div>

                                        <button type="submit" class="fs-6 btn btn-success btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                        <a href="{{route('socialLogin', 'google')}}" class="fs-6 btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw fs-6"></i> Login with Google
                                        </a>
                                      
                                    </form>
                                    <hr>

                                    <div class="text-center ">
                                        <a href="{{route('register')}}" class="fs-6 text-lg text-success">Create an Account!</a>
                                    </div>
                                         <div class="text-center">
                                        <a class="fs-6 text-lg text-success mt-3" href="{{route('password.request')}}">Forgot Password?</a>
                                    </div>
                                     
                                </div>
                        
                        </div>
                    </div>
                </div>

            </div>

        </div>
          </div>

    </div>


@endsection