<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recertificate;
use App\Charts\UserChart;
use DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function admin()
    {
       
        return view('Admin.home');
    }

    public function index()
    {
             $id = Auth::id();
      $user_id  =  DB::table('users')
      ->select('*')
      ->where('id','=',$id)
      ->get();
      foreach ($user_id as $key) {
       
      }
      $user = $key->user_id;

          $Recertificate_count  =  DB::table('totalcertificate')
            ->select('*')
            ->where('ownername','=',$user)
            ->get();

        $expired_count  =  DB::table('expiration_sub')
            ->select('*')
            ->where('ownername','=',$user)
            ->count();

        $sucessful_transaction  =  DB::table('rectransfer_req')
            ->select('*')
            ->where('xferStatus','=','A')
            ->where('ownername','=',$user)
            ->count();

        $pending_transaction  =  DB::table('rectransfer_req')
            ->select('*')
            ->where('xferStatus','=','P')
            ->where('ownername','=',$user)
            ->count();

        return view('Users.home')->with(compact('Recertificate_count'))
        ->with(compact('expired_count'))
        ->with(compact('sucessful_transaction'))
        ->with(compact('pending_transaction'))
        ->with('Success','Welcome '.$user);;
    }
}
