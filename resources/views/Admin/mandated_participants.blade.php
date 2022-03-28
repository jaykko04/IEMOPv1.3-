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
<!-- table table-bordered  -->
<div class="table-responsive py-4">
     <table id="myTable" class="table table-bordered yajra-datatable" style="width:100%">
        <thead class="thead-light">
            <tr>
            
                <th>Participant Name</th>
                <th>Registration Type</th>
                <th>Category Type</th>
                <th>Resource Name</th>
                 <th>Facility Type</th>
                <th>Not Multi Fuel...</th>
                <th>Type Fit</th>
                <th>Eligible Capacity</th>
                 <th>Reg Capacity</th>
                <th>Type</th>
                <th>Vintage</th>
                <th>Status</th>
                <th>Resource Name New</th>
                <th>Remarks</th>
                <th>Region</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
          @foreach($ViewMandatedParticipants as $ViewMandatedParticipants)
          <tr>
            <td>{{$ViewMandatedParticipants->participant_name}}</td>
            <td>{{$ViewMandatedParticipants->registration_type}}</td>
            <td>{{$ViewMandatedParticipants->category_type}}</td>
            <td>{{$ViewMandatedParticipants->resource_name}}</td>
            <td>{{$ViewMandatedParticipants->facility_type}}</td>
             <td>{{$ViewMandatedParticipants->notMultiFuelHybridSystemType}}</td>
            <td>{{$ViewMandatedParticipants->typeFit}}</td>
            <td>{{$ViewMandatedParticipants->eligible_capacity}}</td>
            <td>{{$ViewMandatedParticipants->reg_capacity}}</td>
            <td>{{$ViewMandatedParticipants->Type}}</td>
             <td>{{$ViewMandatedParticipants->vintage}}</td>
            <td>{{$ViewMandatedParticipants->status}}</td>
            <td>{{$ViewMandatedParticipants->resource_name_new}}</td>
             <td>{{$ViewMandatedParticipants->remarks}}</td>
            <td>{{$ViewMandatedParticipants->region}}</td>
            <td><a href=""><i class="fas fa-edit"></i></a> &emsp;<a href=""><i class="fas fa-trash"></i></a></td>
          </tr>
          @endforeach
        </tbody>
      
    </table>
</div>
  
     <script type="text/javascript">
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
@endsection
