@extends('layouts2.master')

@section('content')
<style type="text/css">
  .form-error {

  border: 2px solid #e74c3c;
}
</style>
<div class="header bg-primary pb-1">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Registration</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add New</li>
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
               
               <form method="post" role="form" action="{{ route('Storemandated') }}" enctype="multipart/form-data"> 
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
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('status') }}
              </div>
              @elseif(session('failed'))
              <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('failed') }}
              </div>
              @endif

                <h3>{{ __('PARTICIPANT INFORMATION') }}</h3>
          <hr class="mx-n3">
            <div class="row align-items-center pt-4 pb-3">
                 
              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Participant Name') }}</label>

              </div>
              <div class="col-xl-10 order-xl-2">
                               
                <input type="text" class="form-control form-control-lg{{($errors->first('participant-name') ? ' form-error' : '')}}" name="participant-name" id="participant-name" value="{{ old('participant-name') }}"/>
               

              </div>
            </div>
              <div class="row align-items-center pt-4 pb-3">
                 
              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Short Name') }}</label>

              </div>
              <div class="col-xl-10 order-xl-2">
                               
                <input type="text" class="form-control form-control-lg{{($errors->first('short-name') ? ' form-error' : '')}}" name="short-name" id="short-name" value="{{ old('short-name') }}"/>
               

              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Registration Type') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">

          <select class="form-control form-control-lg{{($errors->first('registration-type') ? ' form-error' : '')}}" name="registration-type" id="registration-type" value="{{ old('registration-type') }}">
           <option value="">Choose</option>
            @foreach($registrationtype as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
            @endforeach
          </select>
              
              </div>
            </div>
               <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Category Type') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">

            <select class="form-control form-control-lg{{($errors->first('category-type') ? ' form-error' : '')}}" name="category-type" id="category-type" value="{{ old('category-type') }}">
             <option value="">Choose</option>
              @foreach($categorytype as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
             
              @endforeach
            </select>

              </div>
            </div>
                <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Resource Name') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">

                <input type="text" class="form-control form-control-lg{{($errors->first('resource-name') ? ' form-error' : '')}}" name="resource-name" id="resource-name" value="{{ old('resource-name') }}"/>

              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Facility Type') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">

             <select class="form-control form-control-lg{{($errors->first('facility-type') ? ' form-error' : '')}}" name="facility-type" id="facility-type" value="{{ old('facility-type') }}">
             <option value="">Choose</option>
              @foreach($facilitytype as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
             
              @endforeach
            </select>
              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Not Multi Fuel Hybrid System Type') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">

              <select class="form-control form-control-lg{{($errors->first('NotMultiFuelhybrid-systemtype') ? ' form-error' : '')}}" name="NotMultiFuelhybrid-systemtype" id="NotMultiFuelhybrid-systemtype" onchange="myFunctions()" value="{{ old('NotMultiFuelhybrid-systemtype') }}">
             <option value="">Choose</option>
              @foreach($notmultifuel as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
             
              @endforeach
            </select>

              </div>
            </div>
            <div id="effect_date" style="display: none"> 
                 <label for="others"  style="font-size: 30px">{{ __('Effectivity_date* ') }}</label>
                  <br>
                  <div class="col-xl-6 order-xl-3">
                  <input type="date" class="form-control form-control-lg{{($errors->first('effectivity-date') ? ' form-error' : '')}}"  id="effectivity-date" name="effectivity-date" value="{{ old('effectivity-date') }}">
                 </div>

              </div>
            <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Type fit') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">
                 <select class="form-control form-control-lg{{($errors->first('type-fit') ? ' form-error' : '')}}" name="type-fit" id="type-fit" value="{{ old('type-fit') }}">
             <option value="">Choose</option>
              @foreach($typefit as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
             
              @endforeach
            </select>
              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Eligible Capacity') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">
                <input type="number" class="form-control form-control-lg{{($errors->first('eligible-capacity') ? ' form-error' : '')}}" name="eligible-capacity" id="eligible-capacity" value="{{ old('eligible-capacity') }}"/>

              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Reg Capacity') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">
                <input type="number" class="form-control form-control-lg{{($errors->first('reg-capacity') ? ' form-error' : '')}}" name="reg-capacity" id="reg-capacity" value="{{ old('reg-capacity') }}"/>

              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Type') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">
                 <select class="form-control form-control-lg{{($errors->first('type') ? ' form-error' : '')}}" name="type" id="type" value="{{ old('type') }}">
                <option value="">Choose</option>
              @foreach($type as $key => $value)
                <option value="{{$value}}">{{$value}}</option>
             
              @endforeach
            </select>
              </div>
            </div>
             
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Vintage') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">
                <input type="text" class="form-control form-control-lg{{($errors->first('vintage') ? ' form-error' : '')}}" name="vintage" id="vintage" value="{{ old('vintage') }}"/>

              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Resource Name New') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">
                <input type="text" class="form-control form-control-lg{{($errors->first('resource-name-new') ? ' form-error' : '')}}" name="resource-name-new" id="resource-name-new" value="{{ old('resource-name-new') }}"/>

              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Remarks') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">
                <input type="text" class="form-control form-control-lg{{($errors->first('remarks') ? ' form-error' : '')}}" name="remarks" id="remarks" value="{{ old('remarks') }}"/>

              </div>
            </div>
             <div class="row align-items-center pt-4 pb-3">
                 

              <div class="col-md-3 ps-5">

                <label class="form-control-label" >{{ __('Region') }}</label>

              </div>
              <div class="col-xl-10 order-xl-1">
                 <select class="form-control form-control-lg{{($errors->first('region') ? ' form-error' : '')}}" name="region" id="region" value="{{ old('region') }}">
             <option value="">Choose</option>
              @foreach($region as $key => $value)
                <option value="{{$key}}">{{$value}}</option>
             
              @endforeach
            </select>
              </div>
            </div>
              <hr class="mx-n3">
            <div class="px-5 py-4">
              <button type="submit"  class="btn btn-primary btn-lg" onclick="return confirm('Are you sure you want to submit this form?')" >{{ __('Save') }}</button>
          <!-- data-toggle="modal" data-target="#saveModal" -->
             <input type="reset"  class="btn btn-primary btn-lg" value="Reset" onclick="return confirm('Reset this form?')">
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
                            a.style.display = "none";
                          }
                   
                      else {
                            y.style.display = "none";
                            a.style.display = "none";
                          }
                                                    }
                
                </script>     
       
@endsection
