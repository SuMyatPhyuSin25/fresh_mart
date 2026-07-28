@extends('customer.layouts.master');

@section('content')

<div class="container " style="margin-top: 150px">
        <div class="row">
            <div class="card col-12 shadow-sm">
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-5">
                            <h5 class="mb-4">Payment methods</h5>


                            @foreach($paymentData as $item)
                            <div class="">
                                <b>{{$item->account_type}}</b> ( Name :  {{$item->account_name}})
                            </div>

                            Account : {{$item->account_number}}

                            <hr>
                            @endforeach

                        </div>
                        <div class="col">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    Payment Info
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <form action="{{route('customer#order')}}" method="post" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row mt-4">
                                                <div class="col">
                                                    <input type="text" name="name" id="" readonly value="{{Auth::user()->name}}"
                                                        class="form-control " placeholder="User Name...">
                                                </div>
                                                <div class="col">
                                                    

                                                        <input type="text" name="phone"
                                                        value="{{ old('phone') }}"
                                                        class="form-control @error('phone') is-invalid @enderror"
                                                        placeholder="09xxxxxxxx">

                                                        @error('phone')
                                                        <small class="invalid invalid-feedback">{{$message}}</small>

                                                        @enderror
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col">
                                                    <textarea  cols="30" rows="10" name="address" id="" value="{{ old('address') }}"
                                                        class="form-control @error('address') is-invalid @enderror" placeholder="Enter address..."> </textarea>
                                                        @error('address')
                                                        <small class="invalid invalid-feedback">{{$message}}</small>

                                                        @enderror
                                                </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col">
                                                  
                                                    <select name="paymentType" id="paymentType" class="form-select @error('paymentType') is-invalid @enderror">
                                                        <option value="">Choose Payment methods...</option>

                                                        @foreach($paymentData as $item)
                                                            <option value="{{ $item->id }}" {{ old('paymentType') == $item->id ? 'selected' : '' }}>
                                                                {{ $item->account_type }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @error('paymentType')
                                                        <div class="error-message" style="color:red; font-size:0.875rem;">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                   
                                                </div>
                                                <div class="col">

                                                    <input type="file" name="payslipImage" id="" class="form-control @error('payslipImage') is-invalid @enderror " value="{{old('payslipImage')}}">
                                                     @error('payslipImage')
                                                        <small class="invalid invalid-feedback">{{$message}}</small>

                                                        @enderror
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col">
                                                    {{-- <input type="hidden" name="orderId" value="{{'order_id'}}"> --}}
                                                    <input type="hidden" name="orderCode" value="{{ $orderData[0]['order_code']}}">
                                                    Order Code : <span class="text-secondary fw-bold">{{ $orderData[0]['order_code']}}</span>
                                                </div>
                                                <div class="col">
                                                    <input type="hidden" name="totalAmount" value="{{$orderData[0]['totalAmt']}}">
                                                    Total amt : <span class=" fw-bold"> {{$orderData[0] ['totalAmt']}} mmk </span>
                                                </div>
                                            </div>

                                            <div class="row mt-4 mx-2">
                                                <button type="submit" class="btn btn-outline-success w-100"><i
                                                        class="fa-solid fa-cart-shopping me-3"></i> Order
                                                    Now...</button>
                                            </div>
                                        </form>
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