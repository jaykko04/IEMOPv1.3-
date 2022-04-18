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
                  <li class="breadcrumb-item"><a href="#">User Registration</a></li>
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
    <br><br>
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
               
          <form method="POST" action="{{ route('registerUser') }}">
                @csrf <!-- {{ csrf_field() }} -->
              
              @if (session('status  '))
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

                <h3>{{ __('USER ACCOUNT') }}</h3>
          <hr class="mx-n3">
           
            <div class="form-group">
                        <select id="role" type="text" class="form-control form-control-user @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}" autocomplete="role" placeholder="role" autofocus>
                           <option value="user">User</option>
                           <option value="admin">Admin</option>
                         </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                       <div class="form-group">
                                   <select id="participant_name" class="form-control form-control-user @error('participant_name') is-invalid @enderror" name="participant_name" value="{{ old('participant_name') }}" required autocomplete="participant_name" placeholder="Participant name" autofocus>
                          <option>Select Participant</option>
                        @foreach($ViewParticipantsName as $key=>$value)
                        
                          <option value="{{$value->resource_name}}">{{$value->resource_name}}</option>

                        @endforeach   
                        </select> 
                                    @error('participant_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                

                                <div class="form-group">
                                    <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address.">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                        <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" required autocomplete="new-password" placeholder="confirm password">
                                </div>  
              <hr class="mx-n3">
            <div class="px-5 py-4">
              <button class="btn btn-primary btn-lg" onclick="return confirm('Are you sure you want to submit this form?')" >{{ __('Add') }}</button>
          <!-- data-toggle="modal" data-target="#saveModal" -->
             <input type="reset"  class="btn btn-primary btn-lg" value="Reset" onclick="return confirm('Reset this form?')">
             </div>
          </div>
        </form>
        </div>

      </div>
    </div>
  </div>
@endsection
