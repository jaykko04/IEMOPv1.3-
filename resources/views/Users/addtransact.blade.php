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
                  <li class="breadcrumb-item active" aria-current="page">Add New Transaction</li>
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
<div class="container ">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-14">
   <div class="card" style="border-radius: 15px;">
          <div class="card-body">
                    @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                  </div><br />
                @endif
                <center>  
                     <h1 >RE Transfer Form</h1>
                </center>
                <p>        The form shall be signed by the authorized signatories of the parties to signify their agreement that the Buying REM Trading Participant is confirming to the details provided thereof by the Selling REM Trading Participant.</p>
               <form method="post" action="{{ route('AddTransaction.store') }}" enctype="multipart/form-data"> 
                @csrf <!-- {{ csrf_field() }} -->
                <div style="text-align: right">
                   <label class="form-control-label">{{ __('Date of Submission:') }} 
                    <p id="date" style="text-align: right"></p>
                    <input type="hidden" name="datetoday" id="datetoday">
                <script>

                var today = new Date();

                var d = (today.getMonth()+1)+'-'+today.getDate()+'-'+today.getFullYear();
                document.getElementById("date").innerHTML = d;
                 document.getElementById("datetoday").value = d;
                </script>
                </label>

              </div>
              @if (session('status'))
              <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('status') }}
              </div>
              @elseif(session('failed'))
              <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('failed') }}
              </div>
              @endif

                <h3>{{ __('I.  SELLING RENEWABLE ENERGY TRADING PARTICIPANT INFORMATION') }}</h3>
                 @foreach($seller as $org_names)
                  @endforeach
            <div class="row align-items-center pt-4 pb-3">
                 
              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Organization Name') }}</label>

              </div>
              <div class="col-xl-12 order-xl-1">
                               
                <input type="text" class="form-control form-control-lg" name="org_name" id="org_name" value="{{ $org_names->resource_name }}" readonly/>
               

              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Short Name') }}</label>

              </div>
              <div class="col-xl-12 order-xl-1">

                <input type="text" class="form-control form-control-lg" name="ownername" id="ownername" readonly value="{{ $org_names->resource_name }}" />

              </div>
            </div>
               <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Facility') }}</label>

              </div>
              <div class="col-xl-12 order-xl-1">

                <input type="text" class="form-control form-control-lg" readonly value="{{ $org_names->resource_name }}"/>

              </div>
            </div>
                <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Location') }}</label>

              </div>
              <div class="col-xl-12 order-xl-1">

                <input type="text" class="form-control form-control-lg" readonly value="{{ $org_names->region }}"/>

              </div>
            </div>

            <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-10 ps-5">

                <label class="form-control-label" >{{ __('REM TP Sub-Category (On-Grid or Off-Grid System): ') }}</label>

              </div>
              <div class="col-xl-12 order-xl-1">

                <input type="text" class="form-control form-control-lg" readonly/>

              </div>
            </div>

            <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-10 ps-5">

                <label class="form-control-label" >{{ __('REM Mandated Participant Type: ') }}</label>

              </div>
              <div class="col-xl-12 order-xl-1">

                 <input type="checkbox" disabled>
                  <label >{{ __('Generation Company') }}</label><br>
                  <input type="checkbox"  disabled>
                  <label >{{ __('Suppliers') }}</label><br>
                  <input type="checkbox"  disabled>
                  <label >{{ __('Distribution Utilities') }}</label><br>
                  <label for="others">{{ __('Others') }}</label>
                   <div class="col-xl-6 order-xl-3">
                  <input class="form-control form-control-lg" type="text" id="others" name="others" disabled><br><br>
                    </div>
                  <label for="others">{{ __('Generation Type: ') }}</label>
                 
                  <div class="col-xl-6 order-xl-3">
                    <input type="text" class="form-control form-control-lg" readonly value=""/>
                  </div>
              </div>

            </div>

            <hr class="mx-n3">
           
               <h3>{{ __('II.   BUYING RENEWABLE ENERGY TRADING PARTICIPANT INFORMATION') }}</h3>
            <div class="row align-items-center pt-4 pb-3">
                 
              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Organization Name') }}</label>

              </div>
              <div class="col-xl-12 order-xl-1">
           
                <select class="form-control form-control-lg" name="org_name2" id="org_name2" >
                  <option >Choose Organization Name</option>

                    @foreach($buyer as $org_names2 )
                    @if($org_names2->resource_name)

                  <option value="{{ $org_names2->resource_name }}" data-orgname="{{ $org_names2->resource_name }}" data-orgname2="{{ $org_names2->resource_name }}" data-orgname3="{{ $org_names2->region }}" data-orgname4="">{{ $org_names2->resource_name }}</option>

                  @endif
            @endforeach
                         
                  <script type="text/javascript">

               let sel = document.getElementById('org_name2');
                sel.addEventListener('click', function (e) {
                    let orgname = e.srcElement.selectedOptions["0"].dataset.orgname;
                    let orgname2 = e.srcElement.selectedOptions["0"].dataset.orgname2;
                     let orgname3 = e.srcElement.selectedOptions["0"].dataset.orgname3;
                        let orgname4 = e.srcElement.selectedOptions["0"].dataset.orgname4;
                    document.getElementById('type').value = orgname4;
                    document.getElementById('newownername').value = orgname;
                    document.getElementById('fc').value = orgname2;
                    document.getElementById('region').value = orgname3;
                });
                </script>        
                </select>

              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Short Name') }}</label>

              </div>
              <div class="col-xl-12 order-xl-1">

                <input type="text" class="form-control form-control-lg" id="newownername" name="newownername" readonly />

              </div>
            </div>
               <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Facility') }}</label>

              </div>
              <div class="col-xl-12 order-xl-1">

                <input type="text" class="form-control form-control-lg" id="fc" name="fc" disabled/>

              </div>
            </div>
                <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Location') }}</label>

              </div>
              <div class="col-xl-12 order-xl-1">

                <input type="text" class="form-control form-control-lg"  id="region" name="region" disabled/>

              </div>
            </div>

            <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-10 ps-5">

                <label class="form-control-label" >{{ __('REM TP Sub-Category (On-Grid or Off-Grid System): ') }}</label>

              </div>
              <div class="col-xl-12 order-xl-1">

                <input type="text" class="form-control form-control-lg" disabled/>

              </div>
            </div>

            <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-10 ps-5">

                <label class="form-control-label" >{{ __('REM Mandated Participant Type: ') }}</label>

              </div>
              <div class="col-xl-12 order-xl-1">

                 <input type="checkbox"  disabled> 
                  <label >{{ __('Generation Company') }}</label><br>
                  <input type="checkbox"  disabled>
                  <label >{{ __('Suppliers') }}</label><br>
                  <input type="checkbox" disabled>
                  <label >{{ __('Distribution Utilities') }}</label><br>
                  <label for="others">{{ __('Others') }}</label>
                   <div class="col-xl-6 order-xl-3">
                  <input class="form-control form-control-lg" type="text" id="others" name="others" disabled><br><br>
                    </div>
                  <label for="others">{{ __('Generation Type: ') }}</label>
                 
                  <div class="col-xl-6 order-xl-3">
                    <input type="text" class="form-control form-control-lg" id="type" name="type" disabled/>
                  </div>
              </div>
            </div>
             <hr class="mx-n3">
              <h3>{{ __('III.TRANSFER INFORMATION ') }}</h3>
                     
              <label for="others">{{ __('Type of transfer ') }}</label>
                    <div class="col-xl-6 order-xl-3">
                      <select class="form-control form-control-lg" name="transfer" id="transfer" onchange="myFunctions()" required>
                <option value="0">Choose type of transfer</option>
                  <option value="1">One-off REC Transfer</option>
                   <option value="2">Standing Order Transfer</option>

                </select>
                    </div>

                    <div style="display: none" id="remove">
                <label for="others">{{ __('Technology ') }}</label>
                   
                  <div class="col-xl-6 order-xl-3">
                    <select class="form-control form-control-lg" name="getype" id="getype" onchange="myFunction()" required> 
                       @foreach($Type as $Type )
                  
                      <option value="{{ $Type->Type}}">{{ $Type->Type}}</option>
                      
                         @endforeach
                    </select>
                  </div>
                 
                   <label for="others">{{ __('Issued Date ') }}</label>
                 
                  <div class="col-xl-6 order-xl-3">
                    <select class="form-control form-control-lg" name="issueddate" id="issueddate" onchange="myFunction()" required>
                       @foreach($issueddate as $issueddate )
                      <option value="{{ $issueddate->dateissued}}">{{ $issueddate->dateissued}}</option>
                        @endforeach
                    </select>
                  </div>
                  <label for="others">{{ __('Expiry Date ') }}</label>
                 
                  <div class="col-xl-6 order-xl-3">
                    <select class="form-control form-control-lg" name="expirydate" id="expirydate" onchange="myFunction()" required>
                       @foreach($expirydate as $expirydate )
                      <option value="{{ $expirydate->expirydate}}">{{ $expirydate->expirydate}}</option>
                        @endforeach
                    </select> 
                   
                  </div>
               
                
                   <br>
                </div>
            
               <div id="standing" style="display: none"> 
                 <label for="others"  style="font-size: 30px">{{ __('Standing Order Transfer* ') }}</label>
                  <br>
                 <label for="start">Start month:</label>
                  <div class="col-xl-6 order-xl-3">
                  <input type="month" class="form-control form-control-lg"  id="start" name="start"
                         min="2022-01">

                 <label for="start">End month:</label>
                   <input type="month" class="form-control form-control-lg"  id="end" name="end">
                 </div>

              </div>
               </br>
               <div id="oneoff" style="display: none">
                        <label for="others" style="font-size: 30px">{{ __('One-off REC Transfer* ') }}</label>
                        <div class="col-xl-6 order-xl-3">
                          <input type="date" class="form-control form-control-lg" name="updateddate" id="updateddate"/>
                          <input type="hidden" class="form-control form-control-lg" name="xferStatus" value="P" />
                        </div> 

                </div>

                 <hr class="mx-n3">
              </br>
               <label for="others">{{ __('Price ') }}</label>
                 
                  <div class="col-xl-6 order-xl-3">
                    <input type="number" class="form-control form-control-lg" placeholder="&#8369; " min="1" name="price" required/>
                  </div>
                  <label for="others">{{ __('Volume ') }}</label>
                 
                  <div class="col-xl-6 order-xl-3">
                    <input type="number" class="form-control form-control-lg"  min="1" name="volume" id="volume" required/>
                   
                  </div>
             
                  
                     <script type="text/javascript">
                        function myFunctions(){
                       var x = document.getElementById("oneoff");
                       var y = document.getElementById("standing");
                       var a = document.getElementById("remove");
                     
                     
                      if ($( "#transfer" ).val() === "1"){
                            x.style.display = "block"; 
                            y.style.display = "none";
                            a.style.display = "block";
                          }
                      else if ($( "#transfer" ).val() === "2"){
                            y.style.display = "block"; 
                            x.style.display = "none";
                            a.style.display = "none";
                          }
                      else {
                            x.style.display = "none";
                            y.style.display = "none";
                            a.style.display = "none";
                          }
                                                    }
                
                </script>     
       
           <script language="javascript">
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('#updateddate').attr('min',today);
        
    </script>
            <hr class="mx-n3">
            <h3>{{ __('IV. CONFIRMATION OF COUNTERPARTIES ') }}</h3>
            <div class="row align-items-center py-3">
              <div class="col-xl-12 order-xl-1">
              </div>
              <div class="col-md-9 pe-5">

                <input type="file" class="form-control form-control-lg" id="chooseFile" name="file"  accept="application/pdf" required />
                <div class="small text-muted mt-2">Upload your agreement</div>

              </div>
            </div>

            <hr class="mx-n3">
          <div class="col-xl-12 order-xl-1">

                 <input type="checkbox" id="check" name="check">
                  <label for="check">{{ __('I hereby confirm our agreement') }}</label><br>
                  <p>We hereby confirm our agreement on the transfer of the Renewable Energy Certificate (REC) with details indicated in the Part III of this form.The Buying Renewable Trading Participant hereby confirms the correctness of the information provided.Both parties further authorize IEMOP to facilitate and carry-out the transfer of the RECs indicated between the undersigned counterparties. </p>
                  <a href="{{asset('admin/img/sample-terms-conditions-agreement.pdf')}}" target="_blank">Click this to learn more..</a>
          </div>
              <hr class="mx-n3">
            <div class="px-5 py-4">
              <button type="submit"  class="btn btn-primary btn-lg" >{{ __('Save') }}</button>
          <!-- data-toggle="modal" data-target="#saveModal" -->
             <input type="reset"  class="btn btn-primary btn-lg" value="Reset">
             </div>
          </div>
        </form>
        </div>

      </div>
    </div>
  </div>
@endsection
