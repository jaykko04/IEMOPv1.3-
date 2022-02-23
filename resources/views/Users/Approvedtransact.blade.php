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
                  <li class="breadcrumb-item active" aria-current="page">Approved Transactions</li>
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
    @endif
<!-- table table-bordered  -->
<div class="table-responsive py-4">
     <table id="myTable" class="table table-bordered yajra-datatable" style="width:100%">
        <thead class="thead-light">
            <tr>
              <th>ID</th>
                <th>Seller Name</th>
                <th>Buyer Name</th>
                <th>Price</th>
                <th>Volume</th>
                 <th>Technology</th>
                <th>Date Issued</th>
                <th>Expiry Date</th>
                <th>Scheduled Date of Transfer</th>
                <th>Start Date</th>
                <th>End Date</th>
                 <th>Type of Transfer</th>
                <th>Status</th>
              
                
            </tr>
        </thead>
        <tbody>
          @foreach($rectransfer_req as $rectransfer_req)
        <tr>
            <td>{{$rectransfer_req->id}}</td>
            <td>{{$rectransfer_req->ownername}}</td>
            <td>{{$rectransfer_req->newownername}}</td>
            <td>{{$rectransfer_req->price}}</td>
            <td>{{$rectransfer_req->volume}}</td>
             <td>{{$rectransfer_req->technology}}</td>
            <td>{{$rectransfer_req->dateissued}}</td>
            <td>{{$rectransfer_req->expirydate}}</td>
            <td>{{$rectransfer_req->updateddate}}</td>
            <td>{{$rectransfer_req->start_date}}</td>
            <td>{{$rectransfer_req->end_date}}</td>
              <td>{{$rectransfer_req->transfer_type}}</td>
             @if($rectransfer_req->xferStatus=='A')
              <td ><label style="background-color: green; color:white; border-radius: 10%">Approved</label></td>
                
              @endif
              

  
        </tr>

        @endforeach
        </tbody>
      
    </table>

</div>
  
    <script type="text/javascript">
    $(document).ready( function () {
    $('#myTable').DataTable();
});
    </script>
       
@endsection
