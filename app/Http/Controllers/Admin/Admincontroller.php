<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\mandated_participants;
use App\Models\monthly_customer;
use App\Models\Recertificate;
use App\Models\rectransfer_req;
use App\Models\transfer;
use DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\DataTables\UsersDataTable;
use App\Charts\UserChart;
use Carbon\Carbon;
use PDF;
use Carbon\CarbonPeriod;
class Admincontroller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function Registration()
    {
       
        return view('Admin.registration');
    }
    public function ViewMandatedParticipants()
    {
        $ViewMandatedParticipants  =  DB::table('mandated_participants')
            ->select('*')
            ->get();
        return view('Admin.mandated_participants')->with(compact('ViewMandatedParticipants'));
    }
  
}
