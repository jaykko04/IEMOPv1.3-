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
                  <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
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
      <div class="col-xl-12">
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
               
               <form method="post" action="{{ route('Updatemandated') }}" enctype="multipart/form-data"> 
                @csrf <!-- {{ csrf_field() }} -->
                <div style="text-align: right">
                   <label class="form-control-label">{{ __('Date Today') }} 
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
                <button type="button" class="close" data-dismiss="alert">??</button>
                {{ session('status') }}
              </div>
              @elseif(session('failed'))
              <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">??</button>
                {{ session('failed') }}
              </div>
              @endif

                <h3>{{ __('PARTICIPANT EDIT INFORMATION') }}</h3>
          <hr class="mx-n3">
            <div class="row align-items-center pt-4 pb-3">
                 
              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Participant Name') }}</label>

              </div>
              <div class="col-xl-10 order-xl-2">
                             @foreach($EditMandatedParticipants as $EditMandatedParticipants)

                              @endforeach
                <input type="text" class="form-control form-control-lg" name="participant-name" id="participant-name" value="{{$EditMandatedParticipants->participant_name}}" />
               

              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
                 
              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Short Name') }}</label>

              </div>
              <div class="col-xl-10 order-xl-2">
                               
                <input type="text" class="form-control form-control-lg" name="short-name" id="short-name" value="{{$EditMandatedParticipants->short_name}}"/>
               

              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Registration Type') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">

          <select class="form-control form-control-lg" name="registration-type" id="registration-type" >
           <option value="">Choose</option>
              @foreach($registrationtype as $key=>$value)
                @if($EditMandatedParticipants->registration_type == $key)
                <option value="{{$key}}" {{ $EditMandatedParticipants->registration_type == $key ? 'selected' : '' }}>{{$value}}</option>
                @else
                <option value="{{$key}}">{{$value}}</option>
                @endif
              @endforeach
          </select>
              
              </div>
            </div>
               <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Category Type') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">

            <select class="form-control form-control-lg" name="category-type" id="category-type" >
             <option value="">Choose</option>
           @foreach($categorytype as $key=>$value)
                @if($EditMandatedParticipants->category_type == $key)
                <option value="{{$key}}" {{ $EditMandatedParticipants->category_type == $key ? 'selected' : '' }}>{{$value}}</option>
                @else
                <option value="{{$key}}">{{$value}}</option>
                @endif
              @endforeach
            </select>

              </div>
            </div>
                <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Resource Name') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">

                <input type="text" class="form-control form-control-lg" name="resource-name" id="resource-name" value="{{$EditMandatedParticipants->resource_name}}"/>

              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Facility Type') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">

             <select class="form-control form-control-lg" name="facility-type" id="facility-type" >
             <option value="">Choose</option>
            @foreach($facilitytype as $key=>$value)
                @if($EditMandatedParticipants->facility_type == $key)
                <option value="{{$key}}" {{ $EditMandatedParticipants->facility_type == $key ? 'selected' : '' }}>{{$value}}</option>
                @else
                <option value="{{$key}}">{{$value}}</option>
                @endif
              @endforeach
            </select>
              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Not Multi Fuel Hybrid System Type') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">

              <select class="form-control form-control-lg" name="NotMultiFuelhybrid-systemtype" id="NotMultiFuelhybrid-systemtype" onchange="myFunctions()">
             <option value="">Choose</option>
           @foreach($notmultifuel as $key=>$value)
                @if($EditMandatedParticipants->notMultiFuelHybridSystemType == $key)
                <option value="{{$key}}" {{ $EditMandatedParticipants->notMultiFuelHybridSystemType == $key ? 'selected' : '' }}>{{$value}}</option>
                @else
                <option value="{{$key}}">{{$value}}</option>
                @endif
              @endforeach
            </select>
              </div>
              
            </div>
            @if($EditMandatedParticipants->notMultiFuelHybridSystemType == 1)
             <div id="effect_date" style="display: block"> 
                 <label for="others"  style="font-size: 30px">{{ __('Effectivity_date* ') }}</label>
                  <br>
                  <div class="col-xl-6 order-xl-3">
                     @foreach($EditParticipant_pef as $EditParticipant_pef)
                      @endforeach
                  <input type="date" class="form-control form-control-lg"  id="effectivity-date" name="effectivity-date" value="{{ $EditParticipant_pef->effectivity_date }}">
                 
                 </div>

              </div>
              @else
               <div id="effect_date" style="display: none"> 
                 <label for="others"  style="font-size: 30px">{{ __('Effectivity_date* ') }}</label>
                  <br>
                  <div class="col-xl-6 order-xl-3">
                   
                  <input type="date" class="form-control form-control-lg"  id="effectivity-date" name="effectivity-date" value="">
                 
                 </div>

              </div>
              @endif
            <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Type fit') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">
                 <select class="form-control form-control-lg" name="type-fit" id="type-fit" >
             <option value="">Choose</option>
             @foreach($typefit as $key=>$value)
                @if($EditMandatedParticipants->typeFit == $key)
                <option value="{{$key}}" {{ $EditMandatedParticipants->typeFit == $key ? 'selected' : '' }}>{{$value}}</option>
                @else
                <option value="{{$key}}">{{$value}}</option>
                @endif
              @endforeach
            </select>
              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Eligible Capacity') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">
                <input type="text" class="form-control form-control-lg" name="eligible-capacity" id="eligible-capacity" value="{{$EditMandatedParticipants->eligible_capacity}}"/>

              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Reg Capacity') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">
                <input type="text" class="form-control form-control-lg" name="reg-capacity" id="reg-capacity" value="{{$EditMandatedParticipants->reg_capacity}}"/>

              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Type') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">
                 <select class="form-control form-control-lg" name="type" id="type" >
                  <option value="">Choose</option>
                    @foreach($type as $key=>$value)
                      @if($EditMandatedParticipants->Type == $value)
                      <option value="{{$value}}" {{ $EditMandatedParticipants->Type == $value ? 'selected' : '' }}>{{$value}}</option>
                      @else
                      <option value="{{$value}}">{{$value}}</option>
                      @endif
                    @endforeach
                </select>
              </div>
            </div>
             
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Vintage') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">
                <input type="text" class="form-control form-control-lg" name="vintage" id="vintage" value="{{$EditMandatedParticipants->vintage}}"/>

              </div>
            </div>

             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Status') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">
                 @if($EditMandatedParticipants->status == 1)
               <input type="text" class="form-control form-control-lg" name="status" id="status" value="Active" disabled />
                @else
               <input type="text" class="form-control form-control-lg" name="status" id="status" value="In-Active" disabled />
                @endif
               
              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Resource Name New') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">
                <input type="text" class="form-control form-control-lg" name="resource-name-new" id="resource-name-new" value="{{$EditMandatedParticipants->resource_name_new}}"/>

              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Remarks') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">
                <input type="text" class="form-control form-control-lg" name="remarks" id="remarks" value="{{$EditMandatedParticipants->remarks}}"/>

              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Region') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">
                 <select class="form-control form-control-lg" name="region" id="region" >
             <option value="">Choose</option>
             @foreach($region as $key=>$value)
                @if($EditMandatedParticipants->region == $key)
                <option value="{{$key}}" {{ $EditMandatedParticipants->region == $key ? 'selected' : '' }}>{{$value}}</option>
                @else
                <option value="{{$key}}">{{$value}}</option>
                @endif
              @endforeach
            </select>
              </div>
            </div>
             <input type="hidden" class="form-control form-control-lg" name="id" id="id" value="{{$EditMandatedParticipants->id}}"/>
              <hr class="mx-n3">
            <div class="px-5 py-4">
              <button type="submit"  class="btn btn-primary btn-lg" onclick="return confirm('Are you sure you want to submit this form?')" >{{ __('Update') }}</button>
          <!-- data-toggle="modal" data-target="#saveModal" -->
             
          <a href="{{url('/Admin/View')}}" class="btn btn-primary btn-lg" onclick="return confirm('Changes will be discard. Continue?')">Back</a>
             </div>
          </div>
        </form>
        </div>

      </div>
    </div>
  </div>
  <script type="text/javascript">
                        function myFunctions(){
                       var y = document.getElementById("effect_date");
                       var a = document.getElementById("remove");
                     
                     
                      if ($( "#NotMultiFuelhybrid-systemtype" ).val() === "1"){
                          
                            y.style.display = "block";
                            a.style.display ='None';
                          }
                   
                      else {
                            y.style.display = "none";
                             a.style.display ='None';
                           
                          }
                                        }
                
                </script>     
@endsection
