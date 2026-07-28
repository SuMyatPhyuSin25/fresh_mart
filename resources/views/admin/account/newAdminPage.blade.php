@extends('admin.layouts.master');

@section('content')


  

 <div class="container">
                    <div class="row">
                         <h1 class="h3 mb-3 text-gray-800 text-center">Create New Admin Account</h1>

                        <div class="col-6 offset-3 card p-3 shadow-sm rounded">
                            

                           
                            <form action="{{route('create#newAdmin')}}" method="post">

                                @csrf

                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Enter Name...">
                                            @error('name')
                                                <small class='invalid invalid-feedback'>{{$message}}</small>
                                            @enderror

                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" name="email" value="{{old('email')}}" class="form-control  @error('email') is-invalid @enderror"
                                            placeholder="Enter Email...">
                                            @error('email')
                                                <small class='invalid invalid-feedback'>{{$message}}</small>
                                            @enderror

                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" value="{{old('password')}}" class="form-control  @error('password') is-invalid @enderror "
                                            placeholder="Enter Password...">
                                            @error('password')
                                                <small class='invalid invalid-feedback'>{{$message}}</small>
                                            @enderror

                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" name="confirmPassword" value="{{old('confirmPassword')}}" class="form-control  @error('confirmPassword') is-invalid @enderror"
                                            placeholder="Enter Confirm Passoword...">
                                            @error('confirmPassword')
                                                <small class='invalid invalid-feedback'>{{$message}}</small>
                                            @enderror

                                    </div>

                                    <div class="mb-3">
                                        <input type="submit" value="Create Account"
                                            class=" btn btn-primary w-100 rounded shadow-sm">
                                    </div>
                                </div>
                            </form>


                        </div>

                    </div>
                </div>


            
@endsection