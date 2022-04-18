@extends('layouts2.master')

@section('content')

 <div class="header bg-primary pb-1">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Registration</a></li>
                  <li class="breadcrumb-item active" aria-current="page">View</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
    @elseif(session()->get('failed'))
    <div class="alert alert-danger">
      {{ session()->get('failed') }}  
    </div><br />
    @endif

    <form method="post" action="{{route('Deletemandated')}}" > 
        @csrf <!-- {{ csrf_field() }} -->         
<!-- table table-bordered  -->
<div class="table-responsive py-4">
     <table id="myTable" class="table table-bordered yajra-datatable" style="width:100%">
        <thead class="thead-light">
            <tr>
            
                <th>Name</th>
                  <th>Email</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Role</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
          @foreach($UserList as $UserList)
          <tr>
           
            <td>{{$UserList->name}}</td>
            <td>{{$UserList->email}}</td>
            <td>{{$UserList->created_at}}</td>
             <td>{{$UserList->updated_at}}</td>
                <td>{{$UserList->role}}</td>

             <td><a href="">Edit</a><br><a href="">Delete</a></td>
          </tr>
          @endforeach
        </tbody>
      
    </table>
</div>
  </form>
     <script type="text/javascript">
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
@endsection
