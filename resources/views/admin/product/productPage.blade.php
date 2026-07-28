@extends('admin.layouts.master');

@section('content')

<div class="container">
    <div class=" d-flex justify-content-between my-2">
        <div class="">
            

                <span class="p-2 bg-success btn btn-secondary rounded shadow-sm mr-2"> <i class="fa-solid fa-database mr-2"></i>Total products - {{ $totalProducts}}</span>

            <a href="{{route('product#list')}}"
                class="btn btn-outline-primary active:btn-primary rounded shadow-sm">
                All Products
            </a>


            <a href="{{route('product#list', ['action' => 'lowAmt'])}}" class=" btn btn-outline-danger rounded shadow-sm">Low Stock Product List</a>


        </div>
        <div class="">
            <form action="{{route('product#list')}}" method="get">

                <div class="input-group">
                    <input type="text" name="searchKey" value="{{request('searchKey')}}" class=" form-control"
                        placeholder="Enter Search Key...">
                    <button type="submit" class=" btn bg-dark text-white"> <i
                            class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-hover shadow-sm ">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>



                   @if($products->total() > 0)
                    

                   @foreach($products as $item)
                    <tr>
                        <td> <img src="{{asset('/productImage/'.$item->image)}}" class=" img-thumbnail rounded shadow-sm" style="width:100px"
                                alt="">
                        </td>
                        <td>{{ $item->name}}</td>
                        <td>{{ $item->price}} mmk</td>
                        <td class="col-2">
                            <button type="button" class="btn btn-secondary position-relative">
                            
                                       {{$item->stock}}

                                     @if($item->stock<=50)



                          <span class="position-absolute top-0 start-100 left-0 translate-middle badge rounded-pill bg-danger">


                                    Low Stock
          
                                    </span>
                                    @endif

                

                            </button>
                        </td>
                        <td>{{ $item->category_name}}</td>

                   
                        
                           <td class="">

                            <div class="d-flex ">

                                 <a href="{{ route('product#detail', ['id'=>$item->id, 'slug'=>$item->slug])}}" class="btn btn-sm btn-outline-primary mr-2"> <i
                                    class="fa-solid fa-eye"></i> </a>


                           
                            <a href="{{route('product#edit', ['id' => $item->id, 'slug' => $item->slug])}}" class="btn btn-sm btn-outline-secondary mr-2"> <i
                                    class="fa-solid fa-pen-to-square "></i> </a>

                           <form id="delete-form-{{ $item->id }}" action="{{ route('product#delete', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button class="btn btn-danger btn-sm mr-2" id="deleteButton" data-id="{{ $item->id }}">
                            <i class="fa-solid fa-trash"></i>
                                                
 



                            </div>

                            

                        </td>
                  

                    </tr>

                    @endforeach

                    @else



                     <tr>
                        <td colspan="7">
                            <h5 class=" text-center text-success">There is no products!</h5>
                        </td>
                    </tr>
                    @endif

                

                </tbody>

            </table>
      <span class=" d-flex justify-content-end">{{$products->links()}}</span>


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