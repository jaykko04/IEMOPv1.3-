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
use Illuminate\Support\Facades\Hash;


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

        $EditParticipant_pef  =  DB::table('mandated_participant_pef')
            ->select('*')
            ->where('mandated_participant_id',$id)
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
    

        return view('Admin.registration_edit')->with(compact('EditMandatedParticipants'))->with(compact('EditParticipant_pef'))->with(compact('registrationtype'))->with(compact('categorytype'))->with(compact('facilitytype'))->with(compact('notmultifuel'))->with(compact('typefit'))->with(compact('region'))->with(compact('type'));
    }



    public function Storemandated(Request $request)
    {
        $part_name = $request->input('participant-name');
         $short_name = $request->input('short-name');
        $rt = $request->input('registration-type');
        $ct = $request->input('category-type');
        $rn = $request->input('resource-name');
        $ft = $request->input('facility-type');
        $NMFhst = $request->input('NotMultiFuelhybrid-systemtype');
        $eff_date = $request->input('effectivity-date');
        $tf = $request->input('type-fit');
        $ec = $request->input('eligible-capacity');
        $rc = $request->input('reg-capacity');
        $type = $request->input('type');
        $vintage = $request->input('vintage');
        $status = $request->input('status');
        $rnn = $request->input('resource-name-new');
        $remarks = $request->input('remarks');
        $region = $request->input('region');
        $updatedby = 'admin';
        $status = '1';
        $updateddate = Carbon::now()->format('Y-m-d');
        if($NMFhst == 1)
        {
            $request->validate([
        'participant-name' => 'required|max:30',
         'short-name' => 'required|max:30',
          'registration-type' => 'required',
          'category-type' => 'required',
          'resource-name'=>'required|max:12',
           'facility-type' => 'required',
          'NotMultiFuelhybrid-systemtype' => 'required',
          'effectivity-date'=>'required',
          'type-fit' => 'required',
          'eligible-capacity'=>"required|numeric|between:0,99.0000000000",
          'reg-capacity' => "required|numeric|between:0,99.0000000000",
          'type' => 'required',
           'resource-name-new' => 'required|max:12',
          'remarks' => 'required',
          'region' => 'required'
       ]);
            $data1 = array("participant_name"=>$part_name,
            "short_name"=>$short_name,
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
             "updated_by"=> $updatedby,
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
        'participant-name' => 'required|max:30',
         'short-name' => 'required|max:30',
          'registration-type' => 'required',
          'category-type' => 'required',
          'resource-name'=>'required|max:12',
           'facility-type' => 'required',
          'NotMultiFuelhybrid-systemtype' => 'required',
          'type-fit' => 'required',
          'eligible-capacity'=>"required|numeric|between:0,99.0000000000",
          'reg-capacity' => "required|numeric|between:0,99.0000000000",
          'type' => 'required',
           'resource-name-new' => 'required|max:12',
          'remarks' => 'required',
          'region' => 'required'
       ]);

        $data2 = array("participant_name"=>$part_name,
          "short_name"=>$short_name,
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
             "updated_by"=> $updatedby,
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
        $part_name = $request->input('participant-name');
        $short_name = $request->input('short-name');
        $rt = $request->input('registration-type');
        $ct = $request->input('category-type');
        $rn = $request->input('resource-name');
        $ft = $request->input('facility-type');
        $NMFhst = $request->input('NotMultiFuelhybrid-systemtype');
        $eff_date = $request->input('effectivity-date');
        $tf = $request->input('type-fit');
        $ec = $request->input('eligible-capacity');
        $rc = $request->input('reg-capacity');
        $type = $request->input('type');
        $vintage = $request->input('vintage');
        $status = $request->input('status');
        $rnn = $request->input('resource-name-new');
        $remarks = $request->input('remarks');
        $region = $request->input('region');
        $updatedby = 'admin';
        $status = '1';
        $updateddate = Carbon::now()->format('Y-m-d');

        $request->validate([
        'participant-name' => 'required|max:30',
         'short-name' => 'required|max:30',
          'registration-type' => 'required',
          'category-type' => 'required',
          'resource-name'=>'required|max:12',
           'facility-type' => 'required',
          'NotMultiFuelhybrid-systemtype' => 'required',
          'type-fit' => 'required',
          'eligible-capacity'=>"required|numeric|between:0,99.0000000000",
          'reg-capacity' => "required|numeric|between:0,99.0000000000",
          'type' => 'required',
           'resource-name-new' => 'required|max:12',
          'remarks' => 'required',
          'region' => 'required'
       ]);
 
            DB::update('update mandated_participants set participant_name= ?,
              short_name = ?,
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
                 where id = ?',[$part_name,$short_name,$rt,$ct,$rn,$ft,$NMFhst,$tf,$ec,$rc,$type,$vintage,$status,$rnn,$remarks,$region,$id]);
        return redirect('/Admin/View')->with('success','Edited Successfully!');
    }


      public function Deletemandated(Request $request)
    {
         $id = $request->input('id');
       $NMFhst = $request->input('NMFhst');
       $status = 0;
       if($NMFhst ==1)
       {
           DB::update('update mandated_participants set status= ?
                 where id = ?',[$status,$id]);
             
      // DB::statement("ALTER TABLE mandated_participants AUTO_INCREMENT =  1");   
       }
       else{
         DB::update('update mandated_participants set status= ?
                 where id = ?',[$status,$id]);
       
      // DB::statement("ALTER TABLE mandated_participants AUTO_INCREMENT =  1"); 
       }  
        return redirect('/Admin/View')->with('success','Deleted Successfuly!');
    }
   public function UserRegistration(Request $request)
    {
         $ViewParticipantsName  =  DB::table('add_transaction')
            ->select('*')
            ->get();
        return view('Admin.user_registration')->with(compact('ViewParticipantsName'));
    }
   public function ViewUserList(Request $request)
    {
         $UserList  =  DB::table('users')
            ->select('*')
            ->get();
        return view('Admin.registration_list')->with(compact('UserList'));
    }
  
  public function registerUser(Request $request)
    {
        $role = $request->input('role');
        $participant_name = $request->input('participant_name');
        $email = $request->input('email');
        $password = $request->input('password');
        $password_confirmation = $request->input('password_confirmation');
     
        $request->validate([
        'role' => 'required|max:30',
          'participant_name' => 'required',
          'email' => 'required',
          'password'=>'required|max:12',
           'password_confirmation' => 'required',
       ]);

        if($password != $password_confirmation)
        {
           return redirect('/Admin/UserRegistration')->with('Failed','Password Doesnt Match!');
        }
        $data2 = array("role"=>$role,
            "name"=>$participant_name,
            "email"=>$email,
            "user_id"=>$participant_name,
            "password"=>Hash::make('password'));
           DB::table('users')->insert($data2);

        return redirect('/Admin/ViewUserList')->with('success','User successfuly added!');
    }

}
