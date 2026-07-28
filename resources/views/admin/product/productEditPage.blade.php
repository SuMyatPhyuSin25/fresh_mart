@extends('admin.layouts.master');

@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-8 offset-2">
            <h1 class="h3 mb-3 text-gray-800 text-center">Edit Product</h1>
            <a href="{{route('product#list')}}" class="btn btn-dark text-white shadow-sm mb-2 col-2"> <i class="fa-solid fa-arrow-left mr-1.5"></i> Back</a>
            <div class="card shadow-sm rounded p-4">

                <form action="{{route('product#update', ['id' => $product->id, 'slug' => $product->slug])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Image Upload -->

                    <input type="hidden" name="productId" value="{{$product->id}}">
                    <input type="hidden" name="productImage" value="{{$product->image}}">
                    <div class="mb-3 text-center">

                        <img id="output" src="{{asset('productImage/'.$product->image)}}"  class="img-fluid img-profile img-thumbnail mb-2 " style="max-width: 200px;" alt="Preview" >


                        <input type="file" name="image" class="form-control  text-black  @error('image') is-invalid @enderror " onchange="document.querySelector('#output').src=window.URL.createObjectURL(this.files[0])" accept="image/*">
                        @error('image')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                              
                    </div>

                    <div class="row">
                        <!-- Name -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid   @enderror text-black"
                                    placeholder="Enter product name" value="{{old('name', $product->name)}}">
                                    @error('name')
                                    <p class='invalid invalid-feedback'>{{ $message}}</p>
                                    @enderror
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="categoryId" class="form-label">Category</label>


                <select name="categoryId" id="categoryId" 
    class="form-control @error('categoryId') is-invalid @enderror text-black">

    <option value="" disabled>Choose Category...</option>

    
                          @foreach($category as $item)

                                    <option value="{{$item->id}}" @if(old('categoryId', $product->category_id)===$item->id )                              selected @endif>
                                        {{$item->name}}
                                    </option>

                                    @endforeach 

</select>
                @error('categoryId')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Price -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>

                                <input type="number" step="0.01" id="price" name="price" class="form-control @error('price')  is-invalid   @enderror text-black"
                                    placeholder="Enter price" value="{{old('price',$product->price)}}">
                                     @error('price')
                                    <p class='invalid invalid-feedback'>{{ $message}}</p>
                                    @enderror
                            </div>
                        </div>

                        <!-- Stock -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" id="stock" name="stock" class="form-control @error('stock')  is-invalid   @enderror text-black"
                                    placeholder="Enter stock quantity" value="{{old('stock',$product->stock)}}">
                                     @error('stock')
                                    <p class='invalid invalid-feedback'>{{ $message}}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>

                         <textarea name="description" id="description" rows="5" class="form-control @error('description')  is-invalid  @enderror text-black"
                            placeholder="Enter product description" value="{{old('description',$product->description)}}">{{$product->description}}</textarea> 
                             @error('description')
                                    <p class='invalid invalid-feedback'>{{ $message}}</p>
                                    @enderror
                    </div>

                    <!-- Submit -->
                    <div class="mb-3">
                        <input type="submit" value="Update Product"
                            class="btn btn-primary w-100 rounded shadow-sm">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection