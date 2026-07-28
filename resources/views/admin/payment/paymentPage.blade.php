@extends('admin.layouts.master');

@section('content')


<div class="container">
   
    <div class=" d-flex justify-content-between my-2">
      
       
        <h1 class="h3 mb-3 text-gray-800 text-center">Payment Method List</h1>
        <div class="">
              
            <form action="{{route('payment#list')}}" method="get">

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
                        {{-- <th>Image</th> --}}
                        <th>Account Image</th>
                        <th>Account Number</th>
                        <th>Account Name</th>
                        <th>Account Type</th>
                       
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>



                    @if($payments->total() > 0)
                  
                    @foreach($payments as $item)

                    <tr>
                        <td> <img src="{{asset('paymentMethodImages/' . $item['account_image'])}}" class=" img-thumbnail rounded shadow-sm" style="width:100px"
                                alt="payment-img">
                        </td>

                        <td>{{ $item->account_number}}</td>
                        <td>{{ $item->account_name}}</td>
                        <td>{{ $item->account_type}}</td>
                       
                        <td class="col-2">

                             <div class="d-flex ">


                           
                            <a href="{{route('payment#edit', ['id' => $item->id])}}" class="btn btn-sm btn-outline-secondary mr-2"> <i
                                    class="fa-solid fa-pen-to-square "></i> </a> 


                           <form id="delete-form-{{ $item->id }}" action="{{ route('payment#delete', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button class="btn btn-danger btn-sm mr-2" id="deleteButton" data-id="{{$item->id}}">
                            <i class="fa-solid fa-trash"></i>
                                            


                            </div>

                          
                

                            
                        </td>
                        {{-- <td>{{ $item->category_name}}</td> --}}

                   
                        
                  

                    </tr>

                    @endforeach

                    @else



                     <tr>
                        <td colspan="7">
                            <h5 class=" text-center text-success">No payment method found!</h5>
                        </td>
                    </tr>

                    @endif

                

                </tbody>

            </table>
      <span class=" d-flex justify-content-end">{{$payments->links()}}</span>


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


const confirmDelete = (id) => {

    Swal.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
  if (result.isConfirmed) {
    document.getElementById(`delete-form-${id}`).submit();
  }


});

}


</script>

@endsection