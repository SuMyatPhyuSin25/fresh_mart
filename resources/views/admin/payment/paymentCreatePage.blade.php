@extends('admin.layouts.master');

@section('content')
    <div class="container my-5">
          
        <div class="row">
          
            <div class="col-9 offset-2">

                
                            <h1 class="h3 mb-3 text-gray-800 text-center">Add Payment</h1>
                <div class="card shadow-sm rounded p-4">

                                       
                                        <form action="{{route('payment#submit')}}" method="POST" class="p-3 rounded" enctype="multipart/form-data">
                                                    @csrf

                                                     <!-- Image Upload -->
                    <div class="mb-3 text-center">
                        <img id="output" class="img-fluid img-profile img-thumbnail mb-2" style="max-width: 200px;" alt="Preview">
                        
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror text-black" 
                               onchange="document.querySelector('#output').src = window.URL.createObjectURL(this.files[0])" value="{{old('image')}}" accept="image/*">
                               
                                @error('image')
                                    <p class='invalid invalid-feedback'>{{ $message}}</p>
                                    @enderror
                    </div>

                                            <input type="text" name="accountNumber" value="{{old('accountNumber')}}" class=" form-control @error('accountNumber') is-invalid @enderror"
                                                placeholder="Account Number...">
                                                @error('accountNumber')
                                                <p class="invalid invalid-feedback">{{ $message}}</p>

                                                @enderror
                                                <br>

                                                <input type="text" name="accountName" value="{{old('accountName')}}" class=" form-control @error('accountName') is-invalid @enderror"
                                                placeholder="Account Name...">
                                                @error('accountName')
                                                <p class="invalid invalid-feedback">{{ $message}}</p>

                                                @enderror
                                                   <br> 

                                                
                                                <input type="text" name="accountType" value="{{old('accountType')}}" class=" form-control @error('accountType') is-invalid @enderror"
                                                placeholder="Account Type...">
                                                @error('accountType')
                                                <p class="invalid invalid-feedback">{{ $message}}</p>
                                                @enderror

                                                <br><br>


                                            {{-- <input type="submit" value="Create" class="btn btn-outline-primary mt-3"> --}}
                                              <div class="mb-3">
                        <input type="submit" value="Create Payment Method"
                            class="btn btn-primary w-100 rounded shadow-sm">
                    </div>
                                          
                                        </form>
                                        
                                   
                </div>


            </div>

        </div>
    </div>
@endsection