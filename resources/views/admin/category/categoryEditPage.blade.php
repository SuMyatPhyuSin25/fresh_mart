@extends('
admin.layouts.master');

@section('content')

<div class="container-fluid">
                     <h1 class="h3 mb-3 text-gray-800 text-center">Edit Category</h1>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                      
                      
                    </div>
                          
                    <div class="">
                        <div class="row">
                            <div class="col-4 mx-auto">

                            <a href="{{route('category#list')}}" class="btn btn-sm bg-dark p-2 m-2 text-white">Back</a>


                                <div class="card mx-auto">
                                    <div class="card-body shadow">
                                        <form action="{{route('category#update', $category->id) }}" method="post" class="p-3 rounded">
                                                @csrf

                                            <input type="text" name="categoryName" value="{{old('categoryName', $category->name)}}"
                                                class=" form-control @error('categoryName') is-invalid @enderror "
                                                placeholder="Category Name...">

                                                  @error('categoryName')
                                            <small class="invalid-feedback">{{$message}}</small>

                                            @enderror

                                            <input type="submit" value="Update" class="btn btn-outline-primary mt-3">

                                          
                                        </form>
                                    </div>
                                </div>
                            </div>

                         
                        </div>
                    </div>

                </div>


@endsection
