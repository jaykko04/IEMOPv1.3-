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
       $path1 = storage_path() . "/app/public/JSON/registrationtype.json"; 
        $path2 = storage_path() . "/app/public/JSON/categorytype.json";
        $path3 = storage_path() . "/app/public/JSON/facilitytype.json";
        $path4 = storage_path() . "/app/public/JSON/notmultifuel.json";
        $path5 = storage_path() . "/app/public/JSON/typefit.json";
        $path6 = storage_path() . "/app/public/JSON/region.json";
        $path7 = storage_path() . "/app/public/JSON/type.json";

    $registrationtype = json_decode(file_get_contents($path1), true); 
     $categorytype = json_decode(file_get_contents($path2), true);
      $facilitytype = json_decode(file_get_contents($path3), true); 
      $notmultifuel = json_decode(file_get_contents($path4), true);
      $typefit = json_decode(file_get_contents($path5), true); 
      $region = json_decode(file_get_contents($path6), true);
      $type = json_decode(file_get_contents($path7), true); 
    
        return view('Admin.registration')->with(compact('registrationtype'))->with(compact('categorytype'))->with(compact('facilitytype'))->with(compact('notmultifuel'))->with(compact('typefit'))->with(compact('region'))->with(compact('type'));
    }
    public function ViewMandatedParticipants()
    {
        $ViewMandatedParticipants  =  DB::table('mandated_participants')
            ->select('mandated_participants.*','mandated_participant_pef.effectivity_date')
            ->leftjoin('mandated_participant_pef', 'mandated_participants.id', '=', 'mandated_participant_pef.mandated_participant_id')
            ->get();
     
        $path1 = storage_path() . "/app/public/JSON/registrationtype.json"; 
        $path2 = storage_path() . "/app/public/JSON/categorytype.json";
        $path3 = storage_path() . "/app/public/JSON/facilitytype.json";
        $path4 = storage_path() . "/app/public/JSON/notmultifuel.json";
        $path5 = storage_path() . "/app/public/JSON/typefit.json";
        $path6 = storage_path() . "/app/public/JSON/region.json";
        $path7 = storage_path() . "/app/public/JSON/type.json";

          $registrationtype = json_decode(file_get_contents($path1), true); 
          $categorytype = json_decode(file_get_contents($path2), true);
          $facilitytype = json_decode(file_get_contents($path3), true); 
          $notmultifuel = json_decode(file_get_contents($path4), true);
          $typefit = json_decode(file_get_contents($path5), true); 
          $region = json_decode(file_get_contents($path6), true);
          $type = json_decode(file_get_contents($path7), true); 
        
        return view('Admin.mandated_participants')->with(compact('ViewMandatedParticipants'))->with(compact('registrationtype'))->with(compact('categorytype'))->with(compact('facilitytype'))->with(compact('notmultifuel'))->with(compact('typefit'))->with(compact('region'))->with(compact('type'));
    
    }
     public function EditMandatedParticipants($id)
    {
        $EditMandatedParticipants  =  DB::table('mandated_participants')
            ->select('*')
            ->where('id',$id)
            ->get();
    $path1 = storage_path() . "/app/public/JSON/registrationtype.json"; 
        $path2 = storage_path() . "/app/public/JSON/categorytype.json";
        $path3 = storage_path() . "/app/public/JSON/facilitytype.json";
        $path4 = storage_path() . "/app/public/JSON/notmultifuel.json";
        $path5 = storage_path() . "/app/public/JSON/typefit.json";
        $path6 = storage_path() . "/app/public/JSON/region.json";
        $path7 = storage_path() . "/app/public/JSON/type.json";

    $registrationtype = json_decode(file_get_contents($path1), true); 
     $categorytype = json_decode(file_get_contents($path2), true);
      $facilitytype = json_decode(file_get_contents($path3), true); 
      $notmultifuel = json_decode(file_get_contents($path4), true);
      $typefit = json_decode(file_get_contents($path5), true); 
      $region = json_decode(file_get_contents($path6), true);
      $type = json_decode(file_get_contents($path7), true); 
    

        return view('Admin.registration_edit')->with(compact('EditMandatedParticipants'))->with(compact('registrationtype'))->with(compact('categorytype'))->with(compact('facilitytype'))->with(compact('notmultifuel'))->with(compact('typefit'))->with(compact('region'))->with(compact('type'));
    }
    public function Storemandated(Request $request)
    {
        $part_name = $request->input('part_name');
        $rt = $request->input('rt');
        $ct = $request->input('ct');
        $rn = $request->input('rn');
        $ft = $request->input('ft');
        $NMFhst = $request->input('NMFhst');
        $eff_date = $request->input('eff_date');
        $tf = $request->input('tf');
        $ec = $request->input('ec');
        $rc = $request->input('rc');
        $type = $request->input('type');
        $vintage = $request->input('vintage');
        $status = $request->input('status');
        $rnn = $request->input('rnn');
        $remarks = $request->input('remarks');
        $region = $request->input('region');
        $updatedby = 'admin';
         $status = '1';
        $updateddate = Carbon::now()->format('Y-m-d');
        if($NMFhst == 1)
        {
            $request->validate([
        'part_name' => 'required',
          'rt' => 'required',
          'ct' => 'required',
          'rn'=>'required',
           'ft' => 'required',
          'NMFhst' => 'required',
          'eff_date' => 'required',
          'tf' => 'required',
          'ec'=>'required', 
          'rc' => 'required',
          'type' => 'required',
           'rnn' => 'required',
          'remarks' => 'required',
          'region' => 'required'
       ]);
            $data1 = array("participant_name"=>$part_name,
            "registration_type"=>$rt,
            "category_type"=>$ct,
            "resource_name"=>$rn,
            "facility_type"=>$ft,
            "notMultiFuelHybridSystemType"=>$NMFhst,
            "typeFit"=>$tf,
            "eligible_capacity"=>$ec,
            "reg_capacity"=>$rc,
            "Type"=>$type,
            "vintage"=> $vintage,
            "status"=>$status,
            "resource_name_new"=>$rnn,
            "remarks"=> $remarks,
            "region"=>$region);
         $ViewMandatedParticipants  =  DB::table('mandated_participants')
                    ->select('id')
                    ->get();
            foreach ($ViewMandatedParticipants as $key => $value) {
                
            }
            $man_id = $value->id + 1;
                
             $data3 = array("mandated_participant_id"=>$man_id,"eligible_capacity"=>$ec,
            "reg_capacity"=>$rc,"effectivity_date"=>$eff_date);
           DB::table('mandated_participants')->insert($data1);
           DB::table('mandated_participant_pef')->insert($data3);
        }
        else{
        $request->validate([
        'part_name' => 'required',
          'rt' => 'required',
          'ct' => 'required',
          'rn'=>'required',
           'ft' => 'required',
          'NMFhst' => 'required',
          'tf' => 'required',
          'ec'=>'required', 
          'rc' => 'required',
          'type' => 'required',
           'rnn' => 'required',
          'remarks' => 'required',
          'region' => 'required'
       ]);

        $data2 = array("participant_name"=>$part_name,
            "registration_type"=>$rt,
            "category_type"=>$ct,
            "resource_name"=>$rn,
            "facility_type"=>$ft,
            "notMultiFuelHybridSystemType"=>$NMFhst,
            "typeFit"=>$tf,
            "eligible_capacity"=>$ec,
            "reg_capacity"=>$rc,
            "Type"=>$type,
            "vintage"=> $vintage,
            "status"=>$status,
            "resource_name_new"=>$rnn,
            "remarks"=> $remarks,
            "region"=>$region);
           DB::table('mandated_participants')->insert($data2);
        }
        return redirect('/Admin/View')->with('success','Successfuly added!');
    }

    public function Updatemandated(Request $request)
    {
         $id = $request->input('id');
        $part_name = $request->input('part_name');
        $rt = $request->input('rt');
        $ct = $request->input('ct');
        $rn = $request->input('rn');
        $ft = $request->input('ft');
        $NMFhst = $request->input('NMFhst');
        $tf = $request->input('tf');
        $ec = $request->input('ec');
        $rc = $request->input('rc');
        $type = $request->input('type');
        $vintage = $request->input('vintage');
        $status = $request->input('status');
        $rnn = $request->input('rnn');
        $remarks = $request->input('remarks');
        $region = $request->input('region');
        $updatedby = 'admin';
        $status = '1';
        $updateddate = Carbon::now()->format('Y-m-d');

        $request->validate([
        'part_name' => 'required',
          'rt' => 'required',
          'ct' => 'required',
          'rn'=>'required',
           'ft' => 'required',
          'NMFhst' => 'required',
          'tf' => 'required',
          'ec'=>'required', 
          'rc' => 'required',
          'type' => 'required',
           'rnn' => 'required',
          'remarks' => 'required',
          'region' => 'required'
       ]);
 
            DB::update('update mandated_participants set participant_name= ?,
                registration_type= ?,
                category_type= ?,
                resource_name= ?,
                facility_type= ?,
                notMultiFuelHybridSystemType= ?,
                typeFit= ?,
                eligible_capacity= ?,
                reg_capacity= ?,
                Type= ?,
                vintage= ?,
                status= ?,
                resource_name_new= ?,
                remarks= ?,
                region= ?
                 where id = ?',[$part_name,$rt,$ct,$rn,$ft,$NMFhst,$tf,$ec,$rc,$type,$vintage,$status,$rnn,$remarks,$region,$id]);
        return redirect('/Admin/View')->with('success','Edited Successfuly!');
    }
      public function Deletemandated(Request $request)
    {
         $id = $request->input('id');
         
         DB::update('delete from mandated_participants where id = ?',[$id]);
            
        return redirect('/Admin/View')->with('success','Deleted Successfuly!');
    }
  
}
