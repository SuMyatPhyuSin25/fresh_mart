@extends('admin.layouts.master');

@section('content')

<div class="container my-5">
    <div class="row justify-content-center">
      
        <div class="col-lg-8">
                <h1 class="h3 mb-3 text-gray-800 text-center">Product Detail</h1>
            <!-- Back Button -->
            <a href="{{ route('product#list') }}" class="btn btn-dark text-white shadow-sm mb-3">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>

            <!-- Product Detail Card -->
            <div class="card shadow-sm rounded-3 border-0">
                <div class="card-body p-4">

                    <!-- Image -->
                    <div class="text-center mb-4">
                        <img src="{{asset('/productImage/' . $detailProduct->image)}}"
                             class="img-thumbnail rounded shadow-sm"
                             style="max-width: 250px;"
                             alt="Image preview">
                    </div>

                    <!-- Product Title -->
                    <h3 class="text-center text-primary mb-4"></h3>

                    <!-- Product Information -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <tbody class="text-black">
                                <tr>
                                    <th style="width: 30%">Product Name</th>
                                    <td>{{ $detailProduct->name}}</td>
                                </tr>

                                <tr>
                                    <th>Category</th>
                                    <td>{{$detailProduct->category_name}}</td>
                                </tr>

                                <tr>
                                    <th>Price</th>
                                    <td>{{number_format($detailProduct->price)}} mmk</td>
                                </tr>

                                <tr>
                                    <th>Stock</th>
                                    <td>
                                        <span class="">
                                            {{$detailProduct->stock}}
                                          
                                        </span>
                                        @if($detailProduct->stock <= 3)
                                            <span class="badge bg-danger ms-2 text-white">Low Stock</span>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Description</th>
                                    <td class="text-muted">
                                       {{$detailProduct->description != null ? $detailProduct->description : 'N/A'}}
                                    </td>
                                </tr>

                                <tr>
                                    <th>Created At</th>
                                    <td> {{$detailProduct->created_at->format('d M Y, h:i A') }}</td>
                                </tr>

                                <tr>
                                    <th>Last Updated</th>
                                    <td>{{ $detailProduct->updated_at->format('d M Y, h:i A') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>




@endsection