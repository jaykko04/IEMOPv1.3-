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
                  <li class="breadcrumb-item active" aria-current="page">Pending Transactions</li>
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
              <th>ID</th>
                <th>Seller Name</th>
                <th>Buyer Name</th>
                <th>Price</th>
                <th>Volume</th>
                 <th>Technology</th>
                <th>Date Issued</th>
                <th>Expiry Date</th>
                <th>Scheduled Date of Transfer</th>
                 <th>Type of Transfer</th>
                <th>Status</th>
                <th>Action</th><th></th>
                
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
           

            @if($rectransfer_req->updateddate =="")
            
            <td>{{$rectransfer_req->start_date}} - {{$rectransfer_req->end_date}} </td>
           @else
            <td>{{$rectransfer_req->updateddate}}</td>
            @endif
            
              <td>{{$rectransfer_req->transfer_type}}</td>
             @if($rectransfer_req->xferStatus=='P')
              <td ><label style="background-color: blue; color:white; border-radius: 10%">Pending</label></td>
                
              @endif
              
              
              @if($rectransfer_req->xferStatus=='P' && Auth::user()->user_id ==$rectransfer_req->ownername)
              <td  class="text-center">
             <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#cancelModal{{$rectransfer_req->id}}" data-id="{{$rectransfer_req->id}}">
                    Cancel
                </a>
              </td>
             @else
             <td  class="text-center">
              <a class="btn btn-success" href="#" data-toggle="modal" data-target="#confirmModal{{$rectransfer_req->id}}" data-id="{{$rectransfer_req->id}}">
                    Confirm
                </a>

             <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#cancelModal{{$rectransfer_req->id}}" data-id="{{$rectransfer_req->id}}">
                    Cancel
                </a>
              </td>
              @endif

      <td></td>
        </tr>

<div class="modal fade" id="confirmModal{{$rectransfer_req->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Transaction?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Confirm" below if you are sure on this transaction.</div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                       <form method="post" action="{{ route('AddTransaction.update', $rectransfer_req->id) }}">
                         @csrf
                         @method('PATCH')
                           <button type="submit" class="btn btn-success">Confirm</button>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="cancelModal{{$rectransfer_req->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cancel Transaction?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Confirm" below if you are sure to cancel this transaction.</div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                       <form method="post" action="{{ route('AddTransaction.destroy', $rectransfer_req->id) }}">
                         @csrf
                          @method('DELETE')
                           <button type="submit" class="btn btn-danger">Confirm</button>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>


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
