@extends('layouts.master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


 <div  id="myModal" tabindex="-1" role="dialog"
        aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Year to Display Report</h5>
                   
                </div>
                <form method="get" action="{{ route('report') }}" enctype="multipart/form-data"> 
                <div class="modal-body"> <!-- <input type="date" name="from" id="from" >-<input type="date" name="to" id="to"> -->
                    <select class="form-control" name="from" id="from" required> </select>
                    
                </div>

                <div class="modal-footer">
                   
                    <button type="submit"  class="btn btn-secondary btn-lg" >{{ __('Display') }}</button>
                    
                </div>
              </form>
            </div>
        </div>
    </div>
<script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"> 
    </script>
    <script type="text/javascript">
    let startYear = 2017;
    let endYear = new Date().getFullYear();
    for (i = endYear; i > startYear; i--)
    {
      $('#from').append($('<option />').val(i).html(i));
    
    }
    </script>
   
@endsection