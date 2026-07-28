@extends('admin.layouts.master');

@section('content')
<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Category List</h1>
                    </div>

                    <div class="">
                        <div class="row">
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-body shadow">

                                        <form action="{{route('category#create')}}" method="post" class="p-3 rounded">
                                                    @csrf



                                            <input type="text"  value="{{old('categoryName')}}" class=" form-control @error('categoryName') is-invalid @enderror" name="categoryName"
                                                placeholder="Category Name...">

                                            <input type="submit" value="Create" class="btn btn-outline-primary mt-3">
                                            @error('categoryName')
                                                <small class="invalid-feedback invalid">{{$message}}</small>

                                            @enderror
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>

                      
                            <div class="col">
                             
                                  <!-- <div class="row-6 ">
                                      <form action="">
                                        <div class="input-group mb-3 d-flex justify-content-end">
                                            <input type="text" name="searchKey" value="{{request('searchKey')}}" class="form-control" placeholder="Search...">
                                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                                      
                                    </form>
                                
                              </div> -->

                                <div class="col-7 offset-6.4 row">
            <form action="" method="get">

                <div class="input-group">
                    <input type="text" name="searchKey" value="{{request('searchKey')}}" class=" form-control"
                        placeholder="Enter Search Key...">
                    <button type="submit" class=" btn bg-dark text-white"> <i
                            class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>
                                
                               
                                   
                              
                                <table class="table table-hover shadow-sm bg-success ">
                                    <thead class="bg-primary text-white bg-success">
                                        <tr>
                                          
                                            <th>Name</th>
                                            <th>Created Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @if($categories->total() > 0)
                                        @foreach ($categories as $category)
                                    
                                        <tr>
                                          
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->created_at->format('d M Y') }}</td>
                                            <td class="d-flex gap-2">
                                               
                                                         <a href="{{route('category#edit', $category->id)}}" class="btn btn-sm btn-outline-secondary"> <i
                                                        class="fa-solid fa-pen-to-square"></i> </a>


<form id="delete-form-{{ $category->id }}" action="{{ route('category#delete',$category->id) }}" method="POST">
    @csrf
    @method('DELETE')
</form>

<button class="btn btn-danger btn-sm" id="deleteButton" data-id="{{ $category->id }}">
    <i class="fa-solid fa-trash"></i>
</button>
                                            </td>
                                        </tr>
                                      @endforeach

                                      @else 
                                    <tr>

                              <td colspan="7">
                                        <h5 class=" text-center text-success">There is no data for category!</h5>

                                  </td>                                    
                                </tr>
                                     

                                        @endif
                                    </tbody>
                                </table>

                                <span class=" d-flex justify-content-end">{{$categories->links()}}</span>

                                
                            </div>
                        </div>
                    </div>

                </div>





@endsection

@section('script-content')

<script>

    const deleteButtons = document.querySelectorAll('#deleteButton');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            confirmDelete(this.dataset.id);
        });
    });
    


function confirmDelete(id){

Swal.fire({
  title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
  showCancelButton: true,
  confirmButtonText: "Yes, delete it!"
}).then((result) => {

    if(result.isConfirmed){
        document.getElementById('delete-form-' +id).submit();
    }

});

}

   

</script>


@endsection