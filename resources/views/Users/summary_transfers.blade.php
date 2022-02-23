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
<input type="button" class="btn btn-success" value="Print" onclick="printData() ">
<!-- table table-bordered  -->
<div class="table-responsive py-4">
     <table id="myTable" class="data-table display" style="width:100%" >
        <thead class="thead-light">
            <tr>
              <th>Date of Transfer</th>
                <th>Counter Party</th>
                <th>Type of Transfer</th>
                <th>Price</th>
                <th>Volume</th>    
            </tr>
        </thead>
        <tbody >

          @foreach($rectransfer_req as $rectransfer_req)

         
        <tr>
          
            <td>{{$rectransfer_req->updateddate}}</td>

              <td>{{$rectransfer_req->newownername}}</td>
              <td>{{$rectransfer_req->transfer_type}}</td>
              <td>{{$rectransfer_req->price}}</td>
              @if($rectransfer_req->newownername=='1BT2020_G01')
              {
                <td><p  style="color:red;">-{{$rectransfer_req->volume}}</p></td>
              }
              @else
              {
                 <td ><p  style="color:lightgreen;">+{{$rectransfer_req->volume}}</p></td>
              }
              @endif
           
           
        </tr>
      
 @endforeach
 <tr></tr>
 <tr>
<td>-</td>
<td>-</td>
<td>-</td>

<td><h5>Total Rec's Transfered: </h5></td>

  <td><h3>{{$rectransfer_req->volume}}</h3></td></tr>
        </tbody>
      
    </table>
</div>
  <script lang='javascript'>
   function printData()
{
   var divToPrint=document.getElementById("myTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}
</script>
     <script type="text/javascript">
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
@endsection
