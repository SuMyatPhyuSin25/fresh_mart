@extends('admin.layouts.master');

@section('content')
   <div class="container">
                    <div class=" d-flex justify-content-between my-2">
                       
                        <a href="{{route('user#list')}}"> <button class=" btn btn-sm btn-secondary  "> User List</button> </a>

                        <div class="">
                            <form action="{{route('account#adminList')}}" method="get">
                                @csrf

                                <div class="input-group">
                                    <input type="text" name="searchKey" value="{{request('searchKey')}}" class=" form-control"
                                        placeholder="Enter Search Key...">
                                    <button type="submit" class=" btn bg-dark text-white"> <i
                                            class="fa-solid fa-magnifying-glass"></i> </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                              <h1 class="h3 mb-3 text-gray-800 text-center">Admin List</h1>
                            <table class="table table-hover shadow-sm ">
                                <thead class="bg-primary text-white">

                                   
                                    <tr>
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Created Date</th>
                                          <th>Actions</th>
                                      
                                       
                                    </tr>

                                </thead>
                                <tbody>
                              
                                    @if(!$admins->isEmpty())
                                     @foreach($admins as $item)

                                    <tr>

                                        <td>
                                              <img src="{{ $item->profile !=null ? asset('profile/' . $item->profile) : asset('img/default-img.jpg')}}" alt="" class="img-profile img-thumbnail w-50" id="output">
                                        </td>
                                        <td>{{$item->name != null ? $item->name : $item->nickname}}</td>
                                        <td>{{$item->email}}</td>
                                        <td class='col-1'>{!! $item->address !=null ? $item->address : '<span class="text-danger">Not register for address!</span>' !!}</td>
                                         <td class='col-1'>{!! $item->phone !=null ? $item->phone : '<span class="text-danger">Not register for phone!</span>' !!}</td>
                                         <td class='col-1'><span class="btn btn-sm bg-danger text-white rounded shadow-sm">{{$item->role}}</span></td>
                                          <td>{{$item->created_at->format('j-F-Y')}}</td>

                                          
                                        <td>
                                             @if($item->role!='superadmin')

                                   
<form id="delete-form-{{ $item->id }}" action="{{ route('account#delete',$item->id) }}" method="POST">
    @csrf
    @method('DELETE')
</form>


<button class="btn btn-danger btn-sm" id="deleteButton" data-id="{{ $item->id }}">
    <i class="fa-solid fa-trash"></i>
</button>

                                        @endif
                                        </td>

                                    </tr>
                                 @endforeach

                                    @else
                                    <tr>
                                        <td colspan="9" class="text-center text-danger">No data found!</td>
                                    </tr>

                                    @endif
                                  

                                  
                                </tbody>
                                 
                            </table>
                               <span class=" d-flex justify-content-end">{{ $admins->links() }}</span>

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