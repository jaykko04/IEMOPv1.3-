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
            
                <th>Participant Name</th>
                  <th>Short Name</th>
                <th>Registration Type</th>
                <th>Category Type</th>
                <th>Resource Name</th>
                 <th>Facility Type</th>
                <th>Not Multi Fuel...</th>
                <th>Effectivity Date</th>
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
              <td>{{$ViewMandatedParticipants->short_name}}</td>

              @foreach($registrationtype as $key1=>$value1)
                @if($ViewMandatedParticipants->registration_type == $key1)
                <td>{{$value1}}</td>
                @endif
              @endforeach
            
            @foreach($categorytype as $key2=>$value2)
                @if($ViewMandatedParticipants->category_type == $key2)
                <td>{{$value2}}</td>
                @endif
              @endforeach

            <td>{{$ViewMandatedParticipants->resource_name}}</td>


            @foreach($facilitytype as $key3=>$value3)
                @if($ViewMandatedParticipants->facility_type == $key3)
                <td>{{$value3}}</td>
                @endif
              @endforeach

              @foreach($notmultifuel as $key4=>$value4)
                @if($ViewMandatedParticipants->notMultiFuelHybridSystemType == $key4)
                <td>{{$value4}}</td>
                @endif
              @endforeach
                <td> {{$ViewMandatedParticipants->effectivity_date}} </td>
            @foreach($typefit as $key5=>$value5)
                @if($ViewMandatedParticipants->typeFit == $key5)
                <td>{{$value5}}</td>
                @endif
              @endforeach

            <td>{{$ViewMandatedParticipants->eligible_capacity}}</td>
            <td>{{$ViewMandatedParticipants->reg_capacity}}</td>
            <td>{{$ViewMandatedParticipants->Type}}</td>
             <td>{{$ViewMandatedParticipants->vintage}}</td>

               @if($ViewMandatedParticipants->status == 1)
                <td>{{ __('Active') }}</td>
                @else
                 <td>{{ __('In-Active') }}</td>
                @endif
             

            <td>{{$ViewMandatedParticipants->resource_name_new}}</td>
             <td>{{$ViewMandatedParticipants->remarks}}</td>

             @foreach($region as $key6=>$value6)
                @if($ViewMandatedParticipants->region == $key6)
                <td>{{$value6}}</td>
                @endif
              @endforeach

              @if($ViewMandatedParticipants->status == 0)
              
                <input type="hidden" name="id" id="id" value="{{$ViewMandatedParticipants->id}}">
            <td>
              <button type="submit" onclick="return confirm('Are you sure you want to Delete {{$ViewMandatedParticipants->participant_name}} ?')" disabled><i class="fas fa-trash"></i>{{ __('Delete') }}</button></td>
              
              @else
              <input type="hidden" name="id" id="id" value="{{$ViewMandatedParticipants->id}}">
            <td><a href="{{url('/Admin/Registration/Edit',$ViewMandatedParticipants->id)}}" onclick="return confirm('Are you sure you want to edit {{$ViewMandatedParticipants->participant_name}} ?')"><i class="fas fa-edit"></i> Edit</a> &emsp;
              <button type="submit" onclick="return confirm('Are you sure you want to Delete {{$ViewMandatedParticipants->participant_name}} ?')"><i class="fas fa-trash"></i>{{ __('Delete') }}</button></td>
            
            @endif
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
