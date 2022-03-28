<?php

namespace App\Http\Controllers\User;

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
class TransactController extends Controller
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

    public function index()
    {
       
        return view('Users.addtransact');
    }


    public function error()
    {
       
        return view('error');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addtransact(Request $request)
    {
      $id = Auth::id();
      $user_id  =  DB::table('users')
      ->select('*')
      ->where('id','=',$id)
      ->get();
        foreach ($user_id as $key) {
         
        }
        $user = $key->user_id;
       
            $seller = DB::table("add_transaction")
                ->select('*')
                ->orderBy('resource_name')
                ->where('resource_name','=', $user)
                ->get();

            $buyer = DB::table("add_transaction")
                ->select('*')
                ->orderBy('resource_name')
                ->where('resource_name','!=', $user)
                ->get();

            $Type = DB::table("compliance")
               ->orderby('technology','asc')
              ->where('ownername',$user)
              ->groupBy('technology')
               ->get();

            $issueddate = DB::table("compliance")
               ->orderby('dateissued','asc')
               ->where('ownername',$user)
               ->groupBy('dateissued')
               ->get();

            $expirydate = DB::table("compliance")
               ->orderby('expirydate','asc')
               ->where('ownername',$user)
               ->groupBy('expirydate')
               ->get(); 


            $gettype = $request->get('getype');
            $getdateissued = $request->get('isd');
            $getexpirydate = $request->get('ed');


      

return view('Users.addtransact')->with('seller',$seller)
        ->with('buyer',$buyer)
        ->with("Type",$Type)
        ->with("issueddate",$issueddate)
        ->with("expirydate",$expirydate);

    }
    public function pendingtransact()
    {
          $rectransfer_req  =  DB::table('rectransfer_req')
            ->select('*')
            ->where('xferStatus','=','P')
            ->get();

    return view('Users.Pendingtransact', compact('rectransfer_req'));
    }
    
    public function approvedtransact()
    {
           $rectransfer_req  =  DB::table('rectransfer_req')
            ->select('*')
            ->where('xferStatus','=','A')
            ->get();
     return view('Users.Approvedtransact', compact('rectransfer_req'));
    }

    public function store(Request $request)
    {
        $ownername = $request->input('ownername');
        $newownername = $request->input('newownername');
        $xferRequested_by = $request->input('ownername');
        $xferRequestDate = $request->input('updateddate');
        $xferStatus = $request->input('xferStatus');
        $count = $request->input('volume');
        $price = $request->input('price');
        $start = $request->input('start');
        $end = $request->input('end');
        $gettype = $request->input('type');
        $getdateissued = $request->input('issueddate');
        $getexpirydate = $request->input('expirydate');

        $request->validate([
        'file' => 'required|mimes:pdf|max:5048',
          'newownername' => 'required',
          'price' => 'required',
          'volume'=>'required',
          'check'=>'required'
       ]);
        $fileModel = new rectransfer_req;


          if($request->file()) 
          {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $agreement_file_path = $request->file('file')->storeAs('uploads', $fileName, 'public');

            $fileModel->agreement_file_path = '/storage/' . $agreement_file_path;
           /* $fileModel->save();*/
          }
           

          if($start == null && $end ==null)
          {
               $recs  =  DB::table('compliance')
              ->select('*')
              ->where('ownername','=',$ownername)
              ->where('dateissued','=',$getdateissued)
              ->where('expirydate','=',$getexpirydate)
              ->where('technology','=',$gettype)
              ->get();
              foreach ($recs as $recs) {
               
              }
            if($recs->totalrecs < $count)
            {
            return redirect('/Users/AddTransaction')->with('failed','Not enough recs.');
            }
            else if($recs->totalrecs >= $count)
            {
                  $data2 = array("ownername"=>$ownername,"newownername"=>$newownername,"price"=>$price,"volume"=>$count,"technology"=>$gettype,"dateissued"=>$getdateissued,"expirydate"=>$getexpirydate,"updateddate"=>$xferRequestDate,"transfer_type"=>"One-off","xferStatus"=>$xferStatus,"agreement_file_path"=> $agreement_file_path);
                       DB::table('rectransfer_req')->insert($data2);
            return redirect('/Users/PendingTransactions')->with('success','Transaction Successfully created.');
            }
            else
            {
            return redirect('/Users/PendingTransactions')->with('failed','Transaction failed');
            }
          }
          else
          {
             
             
               $data2 = array("ownername"=>$ownername,"newownername"=>$newownername,"price"=>$price,"volume"=>$count,"technology"=>"","dateissued"=>"","expirydate"=>"","start_date"=>$start,"end_date"=>$end,"transfer_type"=>"Standing Order","xferStatus"=>$xferStatus,"agreement_file_path"=> $agreement_file_path);
                 DB::table('rectransfer_req')->insert($data2);
              
          return redirect('/Users/PendingTransactions')->with('success','Transaction Successfully created.');
          }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
     /**
     * Edit the specified resource.
     */
  public function report(Request $request)
    {
        $from = $request->input('from');
       /* $to = $request->input('to');*/
        $date = $from;

      $id = Auth::id();
      $user_id  =  DB::table('users')
      ->select('*')
      ->where('id','=',$id)
      ->get();
      foreach ($user_id as $key) {
       
      }
      $user = $key->user_id;

        $rectransfer_req  =  DB::table('rectransfer_req')
            ->select(DB::raw('*'))
            ->Where('updateddate', 'LIKE',$from.'%')
            ->Where('ownername','=',$user )
            ->orWhere('newownername','=',$user )
            ->Where('xferStatus','=','A' )
            ->where('updateddate','LIKE',$from.'%')
            ->get();

        $rectransfer_req_total  =  DB::table('rectransfer_req')
            ->select(DB::raw('*'))
            ->Where('updateddate', 'LIKE',$from.'%')
            ->Where('ownername','=',$user )
            ->orWhere('newownername','=',$user )
            ->Where('xferStatus','=','A' )
            ->sum('volume');

        $expired  =  DB::table('expiration_main')
            ->select(DB::raw('expirydate'), DB::raw('count(*) as total'))
            ->groupBy('expirydate')
            ->orderBy('expirydate', 'asc')
            ->Where('expirydate', 'like',$from . '%')
            ->where('ownername','=',$user)
            ->take(7)
            ->get();

        $surrendered  =  DB::table('compliance_main')
            ->select(DB::raw('date_generated'), DB::raw('count(*) as total'))
            ->groupBy('date_generated')
            ->orderBy('date_generated', 'asc')
            ->Where('date_generated', 'like', $from . '%')
            ->where('ownername','=',$user)
            ->where('total_surrender','!=','0')
            ->take(7)
            ->get();

        $expired_total  =  DB::table('expiration_sub')
            ->select(DB::raw('*'))
            ->Where('expired_date', 'like', $from . '%')
            ->where('ownername','=',$user)
            ->count();

        $surrendered_total  =  DB::table('compliance_sub')
            ->select(DB::raw('*'))
            ->Where('surrendered_date', 'like', $from . '%')
            ->where('ownername','=',$user)
            ->count();

        $recertificate  =  DB::table('recertificate')
            ->select(DB::raw('dateissued'), DB::raw('count(*) as total'))
            ->groupBy('dateissued')
            ->orderBy('dateissued', 'asc')
            ->Where('dateissued', 'like',$from . '%')
            ->where('ownername','=',$user)
            ->take(7)
            ->get();

        $recs  =  DB::table('recertificate')
            ->select(DB::raw('*'))
            ->Where('dateissued', 'like', $from . '%')
            ->where('ownername','=',$user)
            ->count();
        $recs_total  =  DB::table('recertificate')
            ->select(DB::raw('*'))
            ->where('ownername','=',$user)
            ->count();

        $usersChart = new UserChart;
        $usersChart->minimalist(false);
        
       
        for($i =0; $i < 12; $i++)
              {

     
        if($i==0){
         $arr[$i] = 'January'.' '.$from;}
        elseif($i==1) {
         $arr[$i] = 'February'.' '.$from;}
        elseif($i==2) {
         $arr[$i] = 'March'.' '.$from;}
        elseif($i==3) {
         $arr[$i] = 'April'.' '.$from;}
        elseif($i==4) {
         $arr[$i] = 'May'.' '.$from;}
        elseif($i==5) {
         $arr[$i] = 'June'.' '.$from;}  
        elseif($i==6) {
         $arr[$i] = 'July'.' '.$from;}
        elseif($i==7) {
         $arr[$i] = 'August'.' '.$from;}
        elseif($i==8) {
         $arr[$i] = 'September'.' '.$from;}
        elseif($i==9) {
         $arr[$i] = 'October'.' '.$from;}
        elseif($i==10) {
         $arr[$i] = 'November'.' '.$from;}
        elseif($i==11) {
         $arr[$i] = 'December'.' '.$from;}
        }
        $month = $arr;
        $usersChart->labels($arr);

        foreach ($recertificate as $key) {  
          $x =substr($key->dateissued,5,2);

        for($i =0; $i < 12; $i++)
        {
         
          if($i+1 == $x)
          {
           $arr[$i] = $key->total;
          }
          else{
          $arr[$i] = 0;
           }
        }
        $billing_issued = $arr;
        $usersChart->dataset('Total Issued Recs', 'bar', $arr)->backgroundcolor("rgba(99, 255, 132, 1.0)");
          
            }
         /*foreach ($expired as $key) {
           $x =substr($key->expire_date,5,2);
                for($i =0; $i < 12; $i++)
                {
                      if($i+1 == $x)
                      {
                       $arr[$i] = $key->total;
                      }
                      else{
                      $arr[$i] = 0;
                       }
                }
        $billing_expired = $arr;
        $usersChart->dataset('Total Compliance', 'bar', $arr)
            ->backgroundcolor("rgba(255, 99, 132, 1.0)");

          } */

        foreach ($surrendered as $key) {
               $x =substr($key->date_generated,5,2);
                    for($i =0; $i < 12; $i++)
                    {
                      if($i+1 == $x)
                      {
                       $arr[$i] = $key->total;
                      }
                      else{
                      $arr[$i] = 0;
                       }

                      }
           
              
        $usersChart->dataset('Total Compliance', 'bar', $arr)
                    ->backgroundcolor("rgba(255, 99, 132, 1.0)");
             }

       
         
        foreach ($rectransfer_req as $key) {
          $x =substr($key->updateddate,5,2);
        for($i =0; $i < 12; $i++)
        {
          if($i+1 == $x)
          {
           $arr[$i] = $key->volume;
          }
          else{
          $arr[$i] = 0;
           }
          }
          $billing_rectransfer = $arr;
          $usersChart->dataset('Total Transfered', 'bar', $arr)
              ->backgroundcolor("rgba(99, 132, 255, 1.0)");
            }

            $usersChart->dataset('', 'bar', [0]);
          
        return  view('Users.monthly_rec_report')
          ->with(compact('recertificate'))
          ->with(compact('rectransfer_req'))
          ->with(compact('recs'))
          ->with(compact('date'))
          ->with(compact('usersChart'))
          ->with(compact('rectransfer_req_total'))
          ->with(compact('recs_total'))
          ->with(compact('expired'))
          ->with(compact('surrendered'))
          ->with(compact('surrendered_total'))
          ->with(compact('expired_total'))
          ->with(compact('user'))
           ->with(compact('month'));

        }

        public function generatePDF(Request $request)
        {
           
            $data = [
                'title' => 'Welcome to ItSolutionStuff.com','date' => date('m/d/Y')];
              
            $pdf = PDF::loadView('Users.monthly_rec_report', $data);
        
            return $pdf->stream('MonthlyrecsReport.pdf');
        }

        public function search()
        {
            return  view('Users.modal_search');
        }

        public function update(Request $request, $id)
        {
          $status = 'A';
          $rectransfer_req = DB::table('rectransfer_req')
           ->where('id',$id)
           ->get();
           foreach ($rectransfer_req as $key) {
             if($key->updateddate !="")
             {
                 $sched = array("ownername"=>$key->ownername,"newownername"=>$key->newownername,"volume"=>$key->volume,"technology"=>$key->technology,"transfer_type"=>'One-off',"sched_date_transfer"=>$key->updateddate,"Remarks"=>'Pending',"Status"=>'Pending');
                 DB::table('schedule')->insert($sched);

             }
             else
             {
                $period = CarbonPeriod::create($key->start_date, '1 month', $key->end_date);

                  foreach ($period as $date) {
                      $dates[]= $date->format('Y-m');
                  }
                  for($x = 0; $x < count($dates); $x++)
                  {
                    $sched = array("ownername"=>$key->ownername,"newownername"=>$key->newownername,"volume"=>$key->volume,"technology"=>$key->ownername,"transfer_type"=>'Standing Order',"sched_date_transfer"=>$dates[$x],"Remarks"=>'Pending',"Status"=>'Pending');
                      DB::table('schedule')->insert($sched);
                  }
             }
           }
        DB::update('update rectransfer_req set xferStatus = ? where id = ?',[$status,$id]);
        return redirect('/Users/PendingTransactions');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function destroy($id)
        {
        $delete = DB::table('rectransfer_req')
           ->where('id',$id)
           ->delete();
        return redirect('/Users/PendingTransactions')->with('failed','Transaction Cancelled.');
        }

        public function scheduletransact()
        {
          $id = Auth::id();
          $user_id  =  DB::table('users')
          ->select('*')
          ->where('id','=',$id)
          ->get();
            foreach ($user_id as $key) {
             
            }
             $schedule  =  DB::table('schedule')
                ->select('*')
                ->where('ownername','=',$key->user_id)
                ->get();

        return view('Users.Scheduled', compact('schedule'));
        }
    public function compliance()
    {
       $id = Auth::id();
      $user_id  =  DB::table('users')
      ->select('*')
      ->where('id','=',$id)
      ->get();
      foreach ($user_id as $key) {
       
      }
        $compliance = DB::table('compliance')
          ->select('*')
          ->where('ownername','=',$key->user_id)
          ->get();

      $totalsur = DB::table('compliance_sub')
          ->select('*')
          ->where('ownername','=',$key->user_id)
          ->count();

          $total = DB::table('compliance')
          ->select('*')
          ->where('ownername','=',$key->user_id)
          ->sum('totalrecs');

        return view('Users.compliance')
        ->with(compact('compliance'))
        ->with(compact('total'))
        ->with(compact('totalsur'));
     }

    
      public function expired()
    { $id = Auth::id();
      $user_id  =  DB::table('users')
      ->select('*')
      ->where('id','=',$id)
      ->get();
      foreach ($user_id as $key) {
       
      }
         $expiration  =  DB::table('expiration_main')
            ->select('*')
             ->where('ownername','=',$key->user_id)
            ->groupBy('expirydate')
            ->get();

        return view('Users.expired', compact('expiration'));
    }
        public function compliancereq(Request $request)
        {
                $id = Auth::id();
              $user_id  =  DB::table('users')
              ->select('*')
              ->where('id','=',$id)
              ->get();
              foreach ($user_id as $key) {
               
              }

                $datetoday = Carbon::now();
                $updateby = $key->user_id;
           
        $data = $request->all();
        $ownername = $data['ownername'];
        $dateissued = $data['dateissued'];
        $expirydate = $data['expirydate'];
        $technology = $data['technology'];
        $totalrecs = $data['totalrecs'];
        $surrender = $data['surrender_req'];

        $x =0;
            foreach($ownername as $ownername)
            {

                         $data =array("ownername"=>$updateby,
                          "dateissued"=>$dateissued[$x],
                          "expirydate"=>$expirydate[$x],
                          "technology"=>$technology[$x],
                          "totalrecs"=>$totalrecs[$x],
                          "total_surrender"=>$surrender[$x],
                          "date_generated"=>$datetoday,
                          "updated_by"=>$updateby);

                        DB::table('compliance_main')->insert($data);

                        $recertificate['data']  =  DB::table('recertificate')
                        ->select('*')
                        ->where('ownername','=',$updateby)
                        ->where('technology','=',$technology[$x])
                        ->where('dateissued','=',$dateissued[$x])
                        ->where('expirydate','=',$expirydate[$x])
                        ->take($surrender[$x])
                        ->get();
                         foreach ($recertificate['data'] as $key) {
                                # code...
                             $delete = DB::table('recertificate')
                             ->where('serialnumber',$key->serialnumber)
                             ->delete();

                    // $serialnumber = $request->input('serialnumber');
                        $data2 = array('serialnumber'=>$key->serialnumber,
                          "original_ownername"=>$key->ownername,
                          "ownername"=>$key->ownername,
                          "newownername"=>$key->ownername,
                          "generatorname"=>$key->generatorname,
                          "customerName"=>$key->customerName,
                          "xferRequested_by"=>$key->ownername,
                          "surrendered_date"=>$datetoday,
                          "xferStatus"=>'A',
                          "technology"=>$key->technology,
                          "vintage"=>$key->vintage,
                          "startDate"=>$key->startDate,
                          "endDate"=>$key->endDate,
                          "dateissued"=>$key->dateissued,
                          "expirydate"=>$key->expirydate,
                          "IDParent"=>$key->IDParent,
                          "typeFit"=>$key->typeFIT,
                          "Main_ID"=>$key->ID);
                         DB::table('compliance_sub')->insert($data2);
              
             }

            $x++;
            }
               /* $delete = DB::table('recertificate')
               ->where('ownername',$ownername)
               ->take($surrender)
               ->delete();
              */
              

                return redirect('/Users/compliance')->with('success','Surrender RECs Successfully!');
        }
/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
