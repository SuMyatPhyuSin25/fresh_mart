@extends('admin.layouts.master');

@section('content')



<div class="container my-5">
    <div class="row">
        <div class="col-8 offset-2">
            <a href="{{route('payment#list')}}" class="btn btn-dark text-white shadow-sm mb-2 col-2"> <i class="fa-solid fa-arrow-left mr-1.5"></i> Back</a>
            <div class="card shadow-sm rounded p-4">

                <form action="{{route('payment#update', ['id' => $payment->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Image Upload -->

                    <input type="hidden" name="paymentMethodId" value="{{$payment->id}}">
                    
                    <input type="hidden" name="paymentMethodImage" value="{{$payment->account_image}}">

                    <div class="mb-3 text-center">

                        <img id="output" src="{{asset('paymentMethodImages/'. $payment->account_image)}}"  class="img-fluid img-profile img-thumbnail mb-2 " style="max-width: 200px;" alt="Preview" >


                        <input type="file" name="image" class="form-control  text-black  @error('image') is-invalid @enderror " onchange="document.querySelector('#output').src=window.URL.createObjectURL(this.files[0])" accept="image/*">
                        @error('image')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                              
                    </div>

                    <div class="row">
                        <!-- Name -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="number" class="form-label">Account Number</label>
                                <input type="text" id="number" name="accountNumber" class="form-control @error('accountNumber') is-invalid   @enderror text-black"
                                    placeholder="Enter account number" value="{{old('accountNumber', $payment->account_number)}}">
                                    @error('number')
                                    <p class='invalid invalid-feedback'>{{ $message}}</p>
                                    @enderror
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Account Name</label>
                                    <input type="text" id="accountName" name="accountName" class="form-control @error('accountName') is-invalid   @enderror text-black"
                                    placeholder="Enter account name" value="{{old('accountName', $payment->account_name)}}">
                                    @error('accountName')
                                    <p class='invalid invalid-feedback'>{{ $message}}</p>
                                    @enderror


            
                        </div>

                    </div>

                    <div class="row">
                        <!-- Price -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="type" class="form-label">Account Type</label>

                                <input type="text" id="accountType" name="accountType" class="form-control @error('accountType')  is-invalid   @enderror text-black"
                                    placeholder="Enter account type" value="{{old('accountType',$payment->account_type)}}">
                                     @error('accountType')
                                    <p class='invalid invalid-feedback'>{{ $message}}</p>
                                    @enderror
                            </div>
                        </div>

                       
                       
                    </div>

                    
                 

                    <!-- Submit -->
                    <div class="mb-3">
                        <input type="submit" value="Update Payment method"
                            class="btn btn-primary w-100 rounded shadow-sm">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection