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
                  <li class="breadcrumb-item"><a href="#">Reporting</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Monthly REC's Report</li>
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

<div class="container " >
     <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-14">
   <div class="card" style="border-radius: 15px;">
   
          <div class="card-body" id="pdf" >
                    @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                  </div>
                  <br />
                @endif


                <center>  
                     <h1 style="color:darkblue">MONTHLY RENEWABLE ENERGY CERTIFICATES (REC) REPORT</h1>
                </center>
             
                 @csrf <!-- {{ csrf_field() }} -->
            
            <hr class="mx-n3">
            <h3 style="color:darkblue">Recipient:</h3>
            <table style="width:100%">
              <tr>
                <td>

                <p>Registration/Member Number: 
                  <b>021312445</b></p>
                    <p>Name of Organization:
                      <b>Asian Carbon Neutral Power Corp.</b></p>
                    <p>Address:
                      <b>Makati city</b></p>
                  </td>
                 
                  <td>

                <p>REC Report Reference Number: 
                  <b>11111111111</b></p>
                    <p>Report Issuance Date:
                      <b id="datetoday"></b></p>
                    <p>Month Covered Period:
                      <b>{{$date}}</b></p>
                  </td>
                </tr>

            </table> 

<div class="table-responsive py-4">
  <hr class="mx-n3"> 
     <h5>Total Available RECS as of <b id="today"></b> : <strong style="color:blue; font-size: 40px"> {{$recs_total}} Recs</strong></h5> 
   <hr class="mx-n3"> 
            <h3 style="color:darkblue">TOTAL RECs ISSUANCE</h3>
     <table class="table table-bordered yajra-datatable" style="width:100%">
        <thead class="thead-light">
            <tr>
              <th style="background-color: #4e73df; color:white">Date Issued</th>
                <th style="background-color: #4e73df; color:white">Number of RECs Issued</th>
  
                
            </tr>
        </thead>
        <tbody style="text-align: center;">

          @foreach($recertificate as $recertificate)

         
          <tr>
            
              <td>{{$recertificate->dateissued}}</td>

              <td>{{$recertificate->total}}</td>
          </tr>
           @endforeach
           
           <tr>
          <td><h5>Total REC's Issued:</h5></td>
          <td><h3>{{$recs}}</h3></td>

          </tr>
                  </tbody>
                
              </table>

              <hr class="mx-n3"> 
            <h3 style="color:darkblue">COMPLIANCE</h3>
            <table class="table table-bordered yajra-datatable" style="width:100%">
        <thead class="thead-light">
            <tr>
                <th style="background-color: #4e73df; color:white">Date</th>
                 <th style="background-color: #4e73df; color:white">Number of Recs</th>
                  <th style="background-color: #4e73df; color:white">Surrendered/Expired</th>
            </tr>
        </thead>
         <tbody style="text-align: center;">

           @foreach($expired as $expired)

         
          <tr>
            
              <td>{{$expired->expired_date}}</td>

              <td>{{$expired->total}}</td>
              <td style="color:red">Expired</td>
          </tr>
           @endforeach
        <tr>

          @foreach($surrendered as $surrendered)

         
          <tr>
            
              <td>{{$surrendered->surrendered_date}}</td>

              <td>{{$surrendered->total}}</td>
              <td style="color:red">Surrendered</td>
          </tr>
           @endforeach
        <tr>

          <td></td>

            <td><h5>Total Expired RECs: </h5></td>

              <td><h3>{{$expired_total}}</h3></td></tr>
              <td></td>
              <td><h5>Total Surrendered RECs: </h5></td>

              <td><h3>{{$surrendered_total}}</h3></td></tr>
                  </tbody>
              </table>
                 <hr class="mx-n3"> 
            <h3 style="color:darkblue">SUMMARY OF TRANSFERS</h3>
             <table class="table table-bordered yajra-datatable" style="width:100%" >
        <thead class="thead-light">
            <tr>
              <th style="background-color: #4e73df; color:white">Date of Transfer</th>
                <th style="background-color: #4e73df; color:white">Counter Party</th>
                <th style="background-color: #4e73df; color:white">Type of Transfer</th>
                <th style="background-color: #4e73df; color:white">Price</th>
                <th style="background-color: #4e73df; color:white">Volume</th>    
            </tr>
        </thead>
        <tbody style="text-align: center;">

          @foreach($rectransfer_req as $rectransfer_req)

         
        <tr>
          
            <td>{{$rectransfer_req->updateddate}}</td>

              <td>{{$rectransfer_req->newownername}}</td>
              <td>{{$rectransfer_req->transfer_type}}</td>
              <td>{{$rectransfer_req->price}}</td>
              @if(Auth::user()->user_id == $rectransfer_req->newownername)
                 <td ><p  style="color:green;">+{{$rectransfer_req->volume}}</p></td>
              
              @else
              <td ><p  style="color:red;">-{{$rectransfer_req->volume}}</p></td>
              @endif
              </tr>

      
             @endforeach
            
             <tr>
            <td>-</td>
            <td>-</td>
            <td>-</td>

            <td><h5>Total Rec's Transfered: </h5></td>
             
              <td><h3>{{$rectransfer_req_total}}</h3></td>
           
            </tr>
                    </tbody>
                  
                </table>
          
  <hr class="mx-n3"> 
 <div class="row" id="pr">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Renewable Energy Certificates Monthly Summary</h6>
                   
                </div>
                <!-- Card Body -->
               <!--  <h3 style="margin-left: 20px;">Legend</h3>
                     <h5 style="color: green; margin-left: 20px;">Green - Total Issued Rec's</h5>
                    <h5 style="color: red; margin-left: 20px;">Red - Total Compliance</h5>
                     <h5 style="color: blue; margin-left: 20px;">Blue - Total Transfered</h5> -->


                <div class="card-body" >
                    
                     {!! $usersChart->container() !!}
                </div>
            </div>
        </div>
 @if($usersChart)
    {!! $usersChart->script() !!}
    @endif
        <!-- Pie Chart -->
    
    </div>

    <hr class="mx-n3"> 
    <h3 style="color:darkblue">Renewable Energy Certificates Monthly Summary</h3>
             <table class="table table-bordered yajra-datatable" style="width:100%" >
        <thead class="thead-light">
            <tr>
              <th style="background-color: #4e73df; color:white">Billing Month</th>
                <th style="background-color: #4e73df; color:white">Issued</th>
                <th style="background-color: #4e73df; color:white">Transferred To Counterparty/ies</th>
                <th style="background-color: #4e73df; color:white">Transfered From Counterparty/ies</th>
                <th style="background-color: #4e73df; color:white">Surrendered/compliance</th>    
            </tr>
        </thead>
        <tbody style="text-align: center;">

      
         
        <tr>
           <td>October 2021</td>
           <td>100</td>
            <td>10</td>
            <td>10</td>
            <td>20</td>
              </tr>
        <tr>
           <td>November 2021</td>
           <td>90</td>
            <td>10</td>
            <td>10</td>
            <td>30</td>
              </tr>
                <tr>
           <td>December 2021</td>
           <td>120</td>
            <td>5</td>
            <td>5</td>
            <td>10</td>
              </tr>
              <tr>
           <td>January 2022</td>
           <td>100</td>
            <td>15</td>
            <td>10</td>
            <td>10</td>
              </tr>
             
             <tr>
            <td>-</td>
            <td>-</td>
            <td>-</td>

            <td><h5>Total Available REC’s : </h5></td>
             
              <td><h3>320</h3></td>
           
            </tr>
                    </tbody>
                  
                </table>
          </div>
</div>
          
        <!--  <a onclick="printDiv('pdf')" class="btn btn-primary">Save as PDF</a> -->
            <a href="#" onclick="printDiv('pdf')" class="d-none d-sm-inline-block btn btn-sm btn-primary shadowdow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate PDF Report</a>
           </div>

      </div>
    </div>
  </div>
 
  <script>

                var today = new Date();

                var d = (today.getMonth()+1)+'/'+today.getDate()+'/'+today.getFullYear();

                document.getElementById("datetoday").innerHTML = d;
                document.getElementById("today").innerHTML = d;
/*
    $(document).ready( function () {
    $('yajra-datatable').DataTable({searching: false});
} );
*/
</script>

<script type="text/javascript">

function printDiv(divId) {

  let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');

mywindow.document.write( "<link rel='stylesheet' href='print.css' type='text/css' media='print'/> " );

  mywindow.document.write(document.getElementById(divId).innerHTML);
  mywindow.document.close(); // necessary for IE >= 10
  mywindow.focus(); // necessary for IE >= 10*/

  mywindow.print();
  mywindow.close();

  return true;
}
</script>
  <script src="{{asset('admin/vendor/chart.js/Chart.min.js')}}"></script>

@endsection
