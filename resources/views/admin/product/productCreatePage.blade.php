@extends('admin.layouts.master');


@section('content')


<div class="container my-5">
       
    <div class="row">
        <div class="col-8 offset-2">
              <h1 class="h3 mb-3 text-gray-800 text-center">Add Product</h1>
          
            <div class="card shadow-sm rounded p-4">
                
                <form action="{{route('product#create')}}" method="post" enctype="multipart/form-data">
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

                    <div class="row">
                        <!-- Name -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" id="name" name="name" class="form-control @error('name')  is-invalid   @enderror text-black"
                                    placeholder="Enter product name" value="{{old('name')}}">
                                    @error('name')
                                    <p class='invalid invalid-feedback'>{{ $message}}</p>
                                    @enderror
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="categoryId" class="form-label">Category</label>
                                
                             <select name="categoryId" id="categoryId" class="form-control @error('categoryId') is-invalid @enderror text-black" value="{{old('categoryId')}}">

                                 <option value="">Choose Category...</option>
                                 @foreach($categories as $category)
                                 <option value="{{$category->id}}" @if(old('categoryId') == $category->id) selected @endif>{{$category->name}}</option>


                                 @endforeach

                    
                  
                </select>
                                 @error('categoryId')
                                    <p class='invalid invalid-feedback'>{{ $message}}</p>
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
                                    placeholder="Enter price" value="{{old('price')}}">
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
                                    placeholder="Enter stock quantity" value="{{old('stock')}}">
                                     @error('stock')
                                    <p class='invalid invalid-feedback'>{{ $message}}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" rows="5" class="form-control @error('description')  is-invalid   @enderror text-black"
                            placeholder="Enter product description" value="">{{old('description')}}</textarea>
                             @error('description')
                                    <p class='invalid invalid-feedback'>{{ $message}}</p>
                                    @enderror
                    </div>

                    <!-- Submit -->
                    <div class="mb-3">
                        <input type="submit" value="Create Product"
                            class="btn btn-primary w-100 rounded shadow-sm">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

