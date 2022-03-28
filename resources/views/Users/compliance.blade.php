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
         <form action="{{ route('compliancereq')}}" method="post">

  
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
            </tr>
        </thead>
        <tbody>
        <?php $id = 0; ?>
              @foreach($compliance as $compliance)
           <?php $id++; ?>
            <tr>
            <td>{{$compliance->ownername}} </td>
            <td >{{$compliance->dateissued}}</td>
            <td>{{$compliance->expirydate}}</td>
            <td>{{$compliance->technology}}</td> 
            <td>{{$compliance->totalrecs }}
            </td>
            <td>
               <input type="hidden" name="function_count[{{$id}}]" value="{{$id}}" id="function_count[{{$id}}]">
              <input type="hidden" name="ownername[]" value="{{$compliance->ownername}}" id="ownername">

        <input type="hidden" name="dateissued[]" value="{{$compliance->dateissued}}" id="dateissued">

       <input type="hidden" name="expirydate[]" value="{{$compliance->expirydate}}" id="expirydate">

       <input type="hidden" name="technology[]" value="{{$compliance->technology}}" id="technology">
       <input type="hidden" name="totalrecs[]" value="{{$compliance->totalrecs }}" id="totalrecs">
            <input type="number" name="surrender_req[]" id="surrender_req" value="0" class="form-control col-sm-6" min="0" max="{{$compliance->totalrecs }}" />
              </td>
               
            </tr>
            @endforeach
        </tbody>
      
    </table>

</div>

<!-- table table-bordered  -->
          {{ csrf_field() }}
 <h3 style="float:right; margin-right: 100px"><b>Total RECs Surrender : {{$totalsur}}</b></br></br>

 <b>Total RECs Remaining : {{$total}}</b></h3>
 <button style="position:fixed;
right:20px;
bottom:100px" type="submit" class="btn btn-success"><i class="fas fa-save" style="font-size: 20px"></i> Save Changes</button>

</form>
    <script type="text/javascript">
    $(document).ready( function () {
    $('#myTable').DataTable();
} );

    </script>
       
@endsection
