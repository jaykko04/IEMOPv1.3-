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
                  <li class="breadcrumb-item"><a href="#">REC Transactions</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Running Scheduled</li>
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
     <table id="myTable" class="data-table display" style="width:100%">
        <thead class="thead-light">
            <tr> 
              <th>Type of Transfer</th>
                 <th>Date of Transfer</th>
                  <th>Remarks</th>
                  <th>Status</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($schedule as $sched)
            <tr>
               <td>{{$sched->sched_date_transfer}}</td>
            <td>{{$sched->transfer_type}}</td>
            <td>{{$sched->Remarks}}</td>
            @if($sched->Status=='Pending')
            <td style="color:blue">{{$sched->Status}}</td>
            @elseif($sched->Status=='Success')
             <td style="color:green">{{$sched->Status}}</td>
            @else
             <td style="color:red">{{$sched->Status}}</td>
            @endif
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
