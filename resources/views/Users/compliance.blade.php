@extends('layouts.master')

@section('content')

 <div class="header bg-primary pb-1">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Compliance RECs</a></li>
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
        
<div class="table-responsive py-4">
     <table id="myTable" class="data-table display" style="width:100%">
        <thead class="thead-light">
            <tr> 
              <th>Owner Name</th>
              <th>Date Issued</th>
              <th>Expiry Date</th>
                 <th>Technology</th>
                 <th>Total Recs</th>
                  <th>Surrender</th>
                    <th>Action</th>
            </tr>
        </thead>
        <tbody>
     
            @foreach($compliance as $compliance)
           
            <tr>
            <td>{{$compliance->ownername}} </td>
            <td >{{$compliance->dateissued}}</td>
            <td>{{$compliance->expirydate}}</td>
            <td>{{$compliance->technology}}</td> 
            <td>{{$compliance->totalrecs }}
            </td>
            <td>
            
              {{ Request::get('TotalSurrender') }}
              
              </td>
               <td>
              <a class="btn btn-success" href="#" data-toggle="modal" data-target="#addmodal{{$compliance->ownername}}" data-id="{{$compliance->ownername}}">
                    +
                </a>
              </td> 
            
            </tr>
             <div class="modal fade" id="addmodal{{$compliance->ownername}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Number of RECs to Surrender</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="get" action="">
                <div class="modal-body">
                  <h5>Owner Name : <u>{{$compliance->ownername}}</u></h5>
                   <h5>Technology : <u>{{$compliance->technology}}</u></h5>
                   <h5>Input number of Recs to surrender :</h5>
                  <input type="number" name="TotalSurrender" class="form-control" min="1" max="{{$compliance->totalrecs }}">
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                     
                           <button type="submit" class="btn btn-success">Add</button>
                       
                </div>
                </form>
            </div>
        </div>
   
            @endforeach
        </tbody>
      
    </table>

</div>
  <form action="{{ route('compliancereq')}}" method="post"> 

        <input type="hidden" name="ownername" value="{{$compliance->ownername}}" id="ownername">

        <input type="hidden" name="dateissued" value="{{$compliance->dateissued}}" id="dateissued">

       <input type="hidden" name="expirydate" value="{{$compliance->expirydate}}" id="expirydate">

       <input type="hidden" name="technology" value="{{$compliance->technology}}" id="technology">
       <input type="hidden" name="totalrecs" value="{{$compliance->totalrecs }}" id="totalrecs">
<input type="hidden" name="surrender_req" value="{{ Request::get('TotalSurrender') }}" id="surrender_req">
<!-- table table-bordered  -->
          {{ csrf_field() }}
 <h3 style="float:right; margin-right: 100px"><b>Total RECs Surrender : {{ Request::get('TotalSurrender') }}</b></br></br>

 <b>Total RECs Remaining : {{$compliance->totalrecs }}</b></h3>
 <button style="position:fixed;
right:20px;
bottom:100px" type="submit" class="btn btn-success">{{ __('Save') }}</button>

</form>
    <script type="text/javascript">
    $(document).ready( function () {
    $('#myTable').DataTable();
} );

    </script>
       
@endsection
