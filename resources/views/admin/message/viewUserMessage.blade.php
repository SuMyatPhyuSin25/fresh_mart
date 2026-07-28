@extends('admin.layouts.master');
@section('content')



     <div class="container">
                    <div class=" d-flex justify-content-between my-2">
                            
                            <h1 class="h3 mb-3 text-gray-800 text-center">User Messages</h1>
                      
                        <div class="">
                          
                            
                        </div>
                    </div>
                    <div class="row">
                      
                        <div class="col">

                             
                            <table class="table table-hover shadow-sm ">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Message</th>
                                        <th>Actions</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $item)
                                    <tr>

                                      <td>{{ $item->user_name}}</td>
                                        <td id="orderCode">{{ $item->email}}</td>
                                        <td>{{ $item->message}}</td>

                                           <td class="d-flex gap-2">
                                               
                             
    <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ urlencode($item->email) }}"
       target="_blank"
       class="btn btn-sm btn-success">
        Reply
    </a>



<form id="delete-form-{{ $item->id }}" action="{{ route('message#delete',$item->id) }}" method="POST">
    @csrf
    @method('DELETE')
</form>

<button class="btn btn-danger btn-sm" id="deleteButton" data-id="{{ $item->id }}">
    <i class="fa-solid fa-trash"></i>
</button>
                                            </td>
                                        
                                        
                                       
                                        
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            
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