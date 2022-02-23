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
        /*  $mandated_participants = DB::table("mandated_participants")
           ->orderby('participant_name','asc')
            ->select("participant_name",'resource_name as customerfinal','region as region','Type as Type')
           ->where('resource_name', '=', $user_id);*/

          /*  $seller = DB::table("monthly_customer")
                ->select(DB::raw("NULL as participant_name"),'customerfinal as customerfinal',DB::raw("NULL as region"),DB::raw("NULL as Type"))
                ->where('customerfinalnew', '=', $user_id)
                ->union($mandated_participants)
                ->get();*/
                $seller = DB::table("add_transaction")
                ->select('*')
                ->orderBy('resource_name')
                ->where('resource_name','=', $user)
                ->get();

     /*       $mandated_participants2 = DB::table("mandated_participants")
             ->orderby('participant_name','asc')
            ->select("participant_name",'resource_name as customerfinal','region as region','Type as Type')
            ->where('resource_name', '!=', $user_id);
*/
            $buyer = DB::table("add_transaction")
                ->select('*')
                ->orderBy('resource_name')
                ->where('resource_name','!=', $user)
                ->get();

             $Type = DB::table("mandated_participants")
               ->orderby('Type','asc')
               ->Distinct('Type')
                ->select('Type')
               ->get();

            $issueddate = DB::table("Recertificate")
               ->orderby('dateissued','asc')
               ->Distinct('dateissued')
                ->select('dateissued')
               ->get();

            $expirydate = DB::table("Recertificate")
               ->orderby('expirydate','asc')
               ->Distinct('expirydate')
                ->select('expirydate')
               ->get(); 


             $gettype = $request->get('getype');
             $getdateissued = $request->get('isd');
             $getexpirydate = $request->get('ed');


              $selectserial = DB::table("Recertificate")
               ->orderby('serialnumber','asc')
                ->select('*')
                ->WHERE('technology','=','biomass', 'AND', 'dateissued','=', '2021-10-21' ,'AND', 'expirydate', '=','2024-10-21')
               ->get();
               $Count = $selectserial->count();

        return view('Users.addtransact')->with('seller',$seller)
        ->with('buyer',$buyer)
        ->with("Type",$Type)
        ->with("issueddate",$issueddate)
        ->with("expirydate",$expirydate)
        ->with("Count",$Count);

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
       /* $gettype = $request->get('gettype');
        $getdateissued = $request->get('getdateissued');
        $getexpirydate = $request->get('getexpirydate');*/

        $request->validate([
        'file' => 'required|mimes:pdf|max:5048'
        ]);

        $fileModel = new rectransfer_req;


          if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $agreement_file_path = $request->file('file')->storeAs('uploads', $fileName, 'public');

            $fileModel->agreement_file_path = '/storage/' . $agreement_file_path;
           /* $fileModel->save();*/
          }
           
            for($x=0; $x < $count; $x++)
            {
            $serialnumber['data'] = DB::table('Recertificate')
             ->select('*')
             ->where('ownername', '=', $ownername)
             ->skip($x)
             ->take(1)->get();
                foreach ($serialnumber['data'] as $key) {
                    # code...
             
        // $serialnumber = $request->input('serialnumber');
            $data = array('serialnumber'=>$key->serialnumber,
              "original_ownername"=>$key->ownername,
              "ownername"=>$ownername,
              "newownername"=>$newownername,
              "generatorname"=>$key->generatorname,
              "customerName"=>$key->customerName,
              "xferRequested_by"=>$xferRequested_by,
              "xferRequestDate"=>$xferRequestDate,
              "xferStatus"=>$xferStatus,
              "technology"=>$key->technology,
              "vintage"=>$key->vintage,
              "startDate"=>$key->startDate,
              "endDate"=>$key->endDate,
              "dateissued"=>$key->dateissued,
              "expirydate"=>$key->expirydate,
              "IDParent"=>$key->IDParent,
              "typeFit"=>$key->typeFIT,
              "Main_ID"=>$key->ID);

               DB::table('rectransfer')->insert($data);
           
                                                        }
                                                       
            }
            if($start == null && $end ==null)
            {

               $data2 = array("ownername"=>$ownername,"newownername"=>$newownername,"price"=>$price,"volume"=>$count,"technology"=>$key->technology,"dateissued"=>$key->dateissued,"expirydate"=>$key->expirydate,"updateddate"=>$xferRequestDate,"transfer_type"=>"One-off","xferStatus"=>$xferStatus,"agreement_file_path"=> $agreement_file_path);
            }
            else
            {
               $data2 = array("ownername"=>$ownername,"newownername"=>$newownername,"price"=>$price,"volume"=>$count,"technology"=>"","dateissued"=>"","expirydate"=>"","start_date"=>$start,"end_date"=>$end,"transfer_type"=>"Standing Order","xferStatus"=>$xferStatus,"agreement_file_path"=> $agreement_file_path);
               
            }
            
            DB::table('rectransfer_req')->insert($data2);

        return redirect('/Users/PendingTransactions')->with('success','Transaction Successfully created.');
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
            ->orWhere('updateddate', 'like', '%' . $from . '%')
            ->where('ownername','=',$user or 'newownername','=',$user )
            ->get();

        $rectransfer_req_total  =  DB::table('rectransfer_req')
            ->select(DB::raw('*'))
            ->orWhere('updateddate', 'like', '%' . $from . '%')
            ->where('ownername','=',$user or 'newownername','=',$user )
            ->sum('volume');

        $expired  =  DB::table('Expiration_sub')
            ->select(DB::raw('expired_date'), DB::raw('count(*) as total'))
            ->groupBy('expired_date')
            ->orderBy('expired_date', 'asc')
            ->orWhere('expired_date', 'like', '%' . $from . '%')
            ->where('ownername','=',$user)
            ->take(7)
            ->get();

       $surrendered  =  DB::table('Compliance_sub')
            ->select(DB::raw('surrendered_date'), DB::raw('count(*) as total'))
            ->groupBy('surrendered_date')
            ->orderBy('surrendered_date', 'asc')
            ->orWhere('surrendered_date', 'like', '%' . $from . '%')
            ->where('ownername','=',$user)
            ->take(7)
            ->get();

        $expired_total  =  DB::table('Expiration_sub')
            ->select(DB::raw('*'))
            ->orWhere('expired_date', 'like', '%' . $from . '%')
            ->where('ownername','=',$user)
            ->count();

        $surrendered_total  =  DB::table('Compliance_sub')
            ->select(DB::raw('*'))
            ->orWhere('surrendered_date', 'like', '%' . $from . '%')
            ->where('ownername','=',$user)
            ->count();

        $recertificate  =  DB::table('Recertificate')
            ->select(DB::raw('dateissued'), DB::raw('count(*) as total'))
            ->groupBy('dateissued')
            ->orderBy('dateissued', 'asc')
            ->orWhere('dateissued', 'like', '%' . $from . '%')
            ->where('ownername','=',$user)
            ->take(7)
            ->get();

        $recs  =  DB::table('Recertificate')
            ->select(DB::raw('*'))
            ->orWhere('dateissued', 'like', '%' . $from . '%')
            ->where('ownername','=',$user)
            ->count();
        $recs_total  =  DB::table('Recertificate')
            ->select(DB::raw('*'))
            ->where('ownername','=',$user)
            ->count();

        $usersChart = new UserChart;
        $usersChart->minimalist(false);
        
        $n = 12;

        $currentDate = now()->subMonths($n)->format('M,Y');


        $usersChart->labels(['January','February','March','April','May','June','July','August','September','October','November','December' ]);

        foreach ($recertificate as $key) {  
        $usersChart->dataset('Total Issued Recs', 'bar', [$key->total,0])
            ->backgroundcolor("rgba(99, 255, 132, 1.0)");
            }
         foreach ($expired as $key) {
        $usersChart->dataset('Total Compliance', 'bar', [$key->total,0])
            ->backgroundcolor("rgba(255, 99, 132, 1.0)");
          }
            foreach ($rectransfer_req as $key) {
        $usersChart->dataset('total Transfered', 'bar', [0,$key->volume])
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
        ->with(compact('expired_total'));

    }

     public function generatePDF(Request $request)
    {
       
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
          
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
    DB::update('update rectransfer_req set xferStatus = ? where id = ?',[$status,$id]);
     DB::update('update rectransfer_txn set xferStatus = ? where id = ?',[$status,$id]);
          return redirect('/Users/PendingTransactions');
    }

    /**
     * Update the specified resource in db.
     */
    

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


    $deletes = DB::table('rectransfer_txn')
       ->where('ownername',"1ACNPC_G01" and  'newownername' ,"1AMPHAW_G01")
       ->delete();
 
        return redirect('/Users/PendingTransactions')->with('failed','Transaction Cancelled.');
    }

     public function scheduletransact()
    {
         $schedule  =  DB::table('schedule')
            ->select('*')
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

        return view('Users.compliance')
        ->with(compact('compliance'));
     }

    
      public function expired()
    {
         $expiration  =  DB::table('expiration_main')
            ->select('*')
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
         $ownername = $request->input('ownername');
        $dateissued = $request->input('dateissued');
        $expirydate = $request->input('expirydate');
        $technology = $request->input('technology');
        $totalreqs = $request->input('totalrecs');
        $surrender = $request->input('surrender_req');
        $datetoday = Carbon::now();
        $updateby = $key->user_id;
    
          
               $data = array("ownername"=>$ownername,"dateissued"=>$dateissued,"expirydate"=>$expirydate,"technology"=>$technology,"totalrecs"=>$totalreqs,"total_surrender"=>$surrender,"date_generated"=>$datetoday,"updated_by"=>$updateby);

        $delete = DB::table('recertificate')
       ->where('ownername',$ownername)
       ->take($surrender)
       ->delete();

            DB::table('compliance_main')->insert($data);

        return redirect('/Users/compliance')->with('success','Surrender RECs Successfully!');
    }
/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
