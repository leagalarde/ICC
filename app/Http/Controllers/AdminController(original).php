<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;
use PDF;
class AdminController extends Controller
{


  public function __construct(){
    $this->middleware('auth');
    $this->middleware('Admin');
  }

  public function Dashboard(){
    return view('dashboard');
  }
  public function indexAdmin(){
    $id = session('id');
    //return session('message');
    //$id = 1;
    $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
    $equip = DB::select('SELECT count(CASE WHEN ei_status = "Available" Then 1 END) as "Available",
      count(CASE WHEN ei_status = "Deployed" Then 1 END) as "Deployed",
      count(CASE WHEN ei_status = "Defective" Then 1 END) as "Defective", ec_quantity, ec_category, ec.ec_id as "id"
      FROM `equipment_category` as ec
      JOIN `equipment_info_tbl` as ei ON ec.ec_id = ei.ec_id
      Group By ec_category,ec_quantity,ec.ec_id');
    $project = DB::table('project_tbl as pr')
    ->join('project_info_tbl','pr.proj_no','=','project_info_tbl.proj_no')
    ->join('employee_tbl','project_info_tbl.emp_id','=','employee_tbl.emp_id')
    ->join('contract_info_tbl','contract_info_tbl.ci_no','=','pr.ci_no')
    ->join('contract_bill_tbl','contract_info_tbl.cb_id','=','contract_bill_tbl.cb_id')
    ->join('client_tbl','contract_info_tbl.cl_no','=','client_tbl.cl_no')
    ->where('proj_status','On Going')
    ->where('deleted',0)->get();
    $invoice = DB::table('project_tbl as pr')
    ->join('project_info_tbl as pi','pi.proj_no','=','pr.proj_no')
    ->join('invoice_tbl','invoice_tbl.proj_no','=','pr.proj_no')
    ->join('contract_info_tbl','contract_info_tbl.ci_no','=','pr.ci_no')
    ->where('deleted',0)->get();
    
    $proj = DB::table('project_tbl as pr')
    ->join('project_info_tbl as pi','pr.proj_no','=','pi.proj_no')
    ->join('employee_tbl','pi.emp_id','=','employee_tbl.emp_id')
    ->where('pi.emp_id',$id)
    ->where('deleted',0)->get();
    
    //insert new notif in notification_tbl
    $pr = DB::table('project_tbl as pr')
    ->join('project_info_tbl as pi','pr.proj_no','=','pi.proj_no')
    ->join('employee_tbl','pi.emp_id','=','employee_tbl.emp_id')
    ->where('deleted',0)->get();
    
    foreach($pr as $pr) {

      $days = date_diff(date_create($pr->proj_start_date),date_create("now"))->format('%d');
		  // $days = date_diff(date_create($pr->proj_start_date),date_create("now"));
      echo '<script language="javascript">';
      echo 'console.log(".'.$days.'")';
      echo '</script>';
      
      if($days==30 || $days==60 || $days==90 || $days==120 || $days==150 || $days==180 || $days==210 || $days==240 || $days==270 || $days==300 || $days==330   || $days==360 || $days==390 ){
        $text = "You can now request partial payment for project ".$pr->pi_title;
        $notifco = DB::table('notification_tbl')
        ->whereDate('notif_date', date("Y-m-d"))
        ->where('notif_description',$text)->count();
        if($notifco == 0) {
          DB::table('notification_tbl')->insert([
            'notif_description' => $text,
            'proj_no' => $pr->proj_no,
            'notif_from' => $id,
            'notif_to' => $id,
            'notif_date' => date_create('now'),
            'notif_url' => '/project_edit?id='.$pr->proj_no,
            'notif_pm_url' => '/PM_project_edit?id='.$pr->proj_no,
            'notif_icon' => 'proj.png',
          ]);
        }
      }

    }

		//notification
    $notif = DB::table('notification_tbl as notif')
    ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
    ->where('notif.notif_description', 'not like', '%added%')
    ->orderBy('notif.notif_date', 'desc')
    ->take(5)->get();

    $notifcount = DB::table('notification_tbl as notif')
    ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
    ->where('notif.notif_description', 'not like', '%added%')
    ->where('notif.notif_admin_status','unview')->count();

    return view('indexAdmin',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount, 'empPic' => $empPic,'equip'=>$equip,'project'=>$project,'invoice'=>$invoice]);
  }
  public function adminLogout(){
    session()->forget('id');
    //echo session('id')."BYE";
    return redirect('/');
  }
  
  
  public function Profile(){
    $id = session('id');
    $empPic = DB::table('employee_tbl')
    ->join('users','employee_tbl.emp_id','=','users.emp_id')
    ->where('employee_tbl.emp_id',$id)
    ->where('employee_tbl.emp_status',0)->get();
    
    //notification
    $notif = DB::table('notification_tbl as notif')
    ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
    ->where('notif.notif_description', 'not like', '%added%')
    ->orderBy('notif.notif_date', 'desc')
    ->take(5)->get();

    $notifcount = DB::table('notification_tbl as notif')
    ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
    ->where('notif.notif_description', 'not like', '%added%')
    ->where('notif.notif_admin_status','unview')->count();

    return view('profile',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount, 'empPic'=>$empPic]);
  }
  public function editProfile(Request $req){
    $id = session('id');
    $this->validate(request(),[
      'emp_first_name' => 'required|max:25',
      'emp_middle_initial' => 'required|max:25',
      'emp_last_name' => 'required|max:25',
      'emp_address' => 'required|max:100',
          //'emp_email' => 'required|email|unique:employee_tbl,emp_email,'.$emp_id,
      'emp_contact' => 'required|min:5',
    ]);
    DB::table('employee_tbl')->where('emp_id',$id)->update([
      'emp_first_name' => $_POST['emp_first_name'],
      'emp_middle_initial' => $_POST['emp_middle_initial'],
      'emp_last_name' => $_POST['emp_last_name'],
      'emp_address' => $_POST['emp_address'],
      'emp_email' => $_POST['emp_email'],
      'emp_contact' => $_POST['emp_contact'],
    ]);
    
    $image = $_POST['emp_image'];
    if(!empty($image)){ 
      DB::table('employee_tbl')->where('emp_id',$id)->update([
        'emp_image' => $_POST['emp_image'],
      ]);
      }//if this is not == to previous
      
      return back();
    }
    public function editPassword(Request $req){
      $id = session('id');
      $getpass = DB::table('users')->where('emp_id',$id)->get();
      foreach($getpass as $getpass){
        $pass = $getpass->password;
        $user = $getpass->username;
      }//foreach
      $valuePass = $_POST['password'];
      if($_POST['username'] != $user){
        $this->validate(request(),[
          'username' =>  'required|unique:users,username,'.$id,
          'password' => 'required|confirmed|min:8',
        ]);
      }else{
        $this->validate(request(),[
          'password' => 'required|confirmed|min:8',
        ]);
      }
      if($pass != $valuePass){
        $valuePass = bcrypt($valuePass);
      }//if pass != password
      DB::table('users')->where('emp_id',$id)->update([
        'username' => $_POST['username'],
        'password' => $valuePass,
      ]);
      
      return back();
    }

  //update notif status to 'view'
    public function updatenotif(Request $req){
      DB::table('notification_tbl')->update([
        'notif_admin_status' => 'view'
      ]);
      return response()->json();
    }

  //**** NOTIFICATION *****/////
    public function notification(){
      $id = session('id');
      
      $empPic = DB::table('employee_tbl')
      ->join('users','employee_tbl.emp_id','=','users.emp_id')
      ->where('employee_tbl.emp_id',$id)
      ->where('employee_tbl.emp_status',0)->get();
      
      $not = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
      ->where('notif.notif_description', 'not like', '%added a project to you%')
      ->orderBy('notif.notif_date', 'desc')->get();

    //notification
      $notif = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
      ->where('notif.notif_description', 'not like', '%added%')
      ->orderBy('notif.notif_date', 'desc')
      ->take(5)->get();

      $notifcount = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
      ->where('notif.notif_description', 'not like', '%added%')
      ->where('notif.notif_admin_status','unview')->count();

      return view('notification',['id' => $id, 'not' => $not, 'notif' => $notif, 'notifcount' => $notifcount, 'empPic'=>$empPic]);
    }


//***** COMPANY *****//
    public function Company(){
      $id = session('id');
      $var = DB::table('client_tbl')
      ->join('client_rep_tbl as cr','cr.cl_no','=','client_tbl.cl_no')
      ->where('client_tbl.cl_delete',0)->get();
      $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
      
   //notification
      $notif = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
      ->where('notif.notif_description', 'not like', '%added a project to you%')
      ->orderBy('notif.notif_date', 'desc')
      ->take(5)->get();

      $notifcount = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
      ->where('notif.notif_admin_status','unview')->count();
      
      return view('company',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount, 'var' => $var,'empPic'=>$empPic]);
    }

    public function getCompany(Request $req){
      $type = DB::table('client_tbl')->where('cl_no',$req->id)->get();
      return response()->json($type);
    }

    public function editcompany(){
      $this->validate(request(),[
        'comName' => 'required|min:2',
        'comAddress' => 'required|min:2',
        'comPhone' => 'required|min:5',
      ]);
      DB::table('client_tbl')->where('cl_no',$_POST['id'])->update([
        'cl_company' => $_POST['comName'],
        'cl_address' => $_POST['comAddress'],
        'cl_email' => $_POST['comEmail'],
        'cl_contact' => $_POST['comPhone'],
      ]);
      return redirect('/company');
    }
    public function getClient(Request $req){
      $type = DB::table('client_rep_tbl')->where('cr_id',$req->id)->get();
      return response()->json($type);
    }

    public function editclient(){
      DB::table('client_rep_tbl')->where('cr_id',$_POST['id'])->update([
        'cr_first_name' => $_POST['clientFname'],
        'cr_last_name' => $_POST['clientLname'],
        'cr_address' => $_POST['clientAddress'],
        'cr_email' => $_POST['clientEmail'],
        'cr_contact' => $_POST['clientPhone'],
        'cr_position' => $_POST['clientPosition'],
      ]);
      return redirect('/company');
    }

    public function deletecompany(){
      DB::table('client_tbl')->where('cl_no',$_POST['id'])->update([
        'cl_delete' => 1
      ]);
      DB::table('client_rep_tbl')->where('cl_no',$_POST['id'])->update([
        'cr_delete' => 1
      ]);
      return redirect('/company');
    }



    //***** ENGINEER *****//
    public function Engineer(){
      $id = session('id');
      $var = DB::table('employee_tbl')->join('users','employee_tbl.emp_id','=','users.emp_id')->where('employee_tbl.emp_status',0)->get();
      $type = DB::table('users')->where('el_status',0)->get();
      $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
      
          //notification
      $notif = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
      ->where('notif.notif_description', 'not like', '%added a project to you%')
      ->orderBy('notif.notif_date', 'desc')
      ->take(5)->get();

      $notifcount = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
      ->where('notif.notif_admin_status','unview')->count();
      
      return view('engineer',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount, 'var' => $var,'type' => $type,'empPic'=>$empPic]);
      //*/
      //return view('sample');
    } /*read employee_tbl join employee_login_tbl*/

    public function addengineer(Request $req){
      $this->validate(request(),[
            //'emp_first_name' => $
        'username' => 'required|unique:users',
        'password' => 'required|min:3',
        'el_position' => 'required'
      ]);
      $image = $_POST['emp_image'];
      if(!empty($image)){ 
       $upload = 'public/images';
       $fileName = time().'.'.$image;
       $image->move(public_path('/images'),$filename);
     }
     else {
       $fileName = 'eng2.jpg';
     }
     $id = DB::table('employee_tbl')->insertGetId([
      'emp_first_name' => $_POST['emp_first_name'],
      'emp_middle_initial' => $_POST['emp_middle_initial'],
      'emp_last_name' => $_POST['emp_last_name'],
      'emp_address' => $_POST['emp_address'],
      'emp_email' => $_POST['emp_email'],
      'emp_contact' => $_POST['emp_contact'],
      'emp_image' => $_POST['emp_image'],
    ], 'emp_id');
     DB::table('users')->insert([
      'username' => $_POST['username'],
      'password' => bcrypt($_POST['password']),
      'el_position' => $_POST['el_position'],
      'emp_id' => $id,
    ]);
     return redirect('/engineer');
   }/*insert new engineer to employee_tbl & employee_login_tbl*/

   public function getEngineer(Request $req){
    $type = DB::table('employee_tbl')->join('users','employee_tbl.emp_id','=','users.emp_id')->where('employee_tbl.emp_id',$req->id)->get();
    return response()->json($type);
  }/*get data from employee_tbl & employee_login_tbl*/

  public function editengineer(){
    $emp_id=$_POST['id'];
    $this->validate(request(),[
      'emp_first_name' => 'required|max:25',
      'emp_middle_initial' => 'required|max:25',
      'emp_last_name' => 'required|max:25',
      'emp_address' => 'required|max:100',
            //'emp_email' => 'required|email|unique:employee_tbl,emp_email,'.$emp_id,
      'emp_contact' => 'required|min:5',
            //'username' =>  'required|unique:users,el_position,'.$_POST['id'],
      'password' => 'required|min:8',
      'el_position' => 'required',
    ]);


    DB::table('employee_tbl')->where('emp_id',$_POST['id'])->update([
      'emp_first_name' => $_POST['emp_first_name'],
      'emp_middle_initial' => $_POST['emp_middle_initial'],
      'emp_last_name' => $_POST['emp_last_name'],
      'emp_address' => $_POST['emp_address'],
      'emp_email' => $_POST['emp_email'],
      'emp_contact' => $_POST['emp_contact'],
    ]);
    $image = $_POST['emp_image'];
    if(!empty($image)){ 
     DB::table('employee_tbl')->where('emp_id',$_POST['id'])->update([
      'emp_image' => $_POST['emp_image'],
    ]);
   }
   else {
   }
   $getpass = DB::table('users')->where('emp_id',$_POST['id'])->get();
   foreach($getpass as $getpass){
    $pass = $getpass->password;
        }//foreach
        $valuePass = $_POST['password'];
        if($pass != $valuePass){
          $valuePass = bcrypt($valuePass);
        }//if pass != password
        DB::table('users')->where('emp_id',$_POST['id'])->update([
          'username' => $_POST['username'],
          'password' => $valuePass,
          'el_position' => $_POST['el_position'],
        ]);
        return redirect('/engineer');
      }/*update employee_tbl & employee_login_tbl*/

      public function deleteengineer(){
        DB::table('employee_tbl')->where('emp_id',$_POST['id'])->update([
          'emp_status' => 1
        ]);
        DB::table('users')->where('emp_id',$_POST['id'])->update([
          'el_status' => 1
        ]);
        return redirect('/engineer');
      }/*delete data from employee_tbl & employee_login_tbl*/




//***** PHASE *****//
      public function Phase(){
        $id = session('id');
        $var = DB::table('phase_tbl')->where('phase_delete',0)->get();
        $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
        
          //notification
        $notif = DB::table('notification_tbl as notif')
        ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
        ->where('notif.notif_description', 'not like', '%added a project to you%')
        ->orderBy('notif.notif_date', 'desc')
        ->take(5)->get();

        $notifcount = DB::table('notification_tbl as notif')
        ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
        ->where('notif.notif_admin_status','unview')->count();

        return view('phase',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount, 'var' => $var,'empPic'=>$empPic]);
      }

      public function addphase(){
       DB::table('phase_tbl')->insert([
        'phase_title' => $_POST['phase_title'],
        'phase_description' => $_POST['phase_description']
      ]);
       return redirect('/phase');
     }

     public function getPhase(Request $req){
       $type = DB::table('phase_tbl')->where('phase_id',$req->id)->where('phase_delete',0)->get();
       return response()->json($type);
     }

     public function editphase(){
       DB::table('phase_tbl')->where('phase_id',$_POST['id'])->update([
        'phase_title' => $_POST['phase_title'],
        'phase_description' => $_POST['phase_description']
      ]);
       return redirect('/phase');
     }
     public function deletephase(){
       DB::table('phase_tbl')->where('phase_id',$_POST['id'])->update([
        'phase_delete' => 1
      ]);
       return redirect('/phase');
     }



//***** TASKS *****//
     public function Task(){
      $id = session('id');
      $var = DB::table('task_tbl')
      ->join('phase_tbl','task_tbl.phase_id','=','phase_tbl.phase_id')
      ->where('task_tbl.task_delete',0)
      ->orderBy('task_tbl.phase_id', 'asc')->get();
      $type = DB::table('phase_tbl')->where('phase_delete',0)->get();
      $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
      
      
   //notification
      $notif = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
      ->where('notif.notif_description', 'not like', '%added a project to you%')
      ->orderBy('notif.notif_date', 'desc')
      ->take(5)->get();

      $notifcount = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
      ->where('notif.notif_admin_status','unview')->count();
      
      return view('task',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount,'var' => $var,'type' => $type,'empPic'=>$empPic]);
    }

    public function addtask(){
      $this->validate(request(),[
        'task_item_no' => 'required',
        'task_description' => 'required',
        'task_phase' => 'required',
        'task_type' => 'required',
        'plan_unit' => 'required',
        'plan_unit_cost' => 'required'
      ]);
      DB::table('task_tbl')->insert([
        'task_item_no' => $_POST['task_item_no'],
        'task_description' => $_POST['task_description'],
        'phase_id' => $_POST['task_phase'],
        'task_type' => $_POST['task_type'],
        'task_unit' => $_POST['plan_unit'],
        'task_unit_cost' => $_POST['plan_unit_cost'],
      ]);
      return redirect('/tasks');
    }

    public function getTask(Request $req){
      $type = DB::table('task_tbl')->join('phase_tbl','task_tbl.phase_id','=','phase_tbl.phase_id')
      ->where('task_tbl.task_id',$req->id)
      ->where('task_tbl.task_delete',0)->get();
      return response()->json($type);
    }

    public function edittask(){
      $this->validate(request(),[
        'task_item_no' => 'required',
        'task_description' => 'required',
        'task_phase' => 'required',
        'task_type' => 'required',
        'plan_unit' => 'required',
        'plan_unit_cost' => 'required'
      ]);
      DB::table('task_tbl')->where('task_id',$_POST['id'])->update([
        'task_item_no' => $_POST['task_item_no'],
        'task_description' => $_POST['task_description'],
        'phase_id' => $_POST['task_phase'],
        'task_type' => $_POST['task_type'],
        'task_unit' => $_POST['plan_unit'],
        'task_unit_cost' => $_POST['plan_unit_cost'],
      ]);
      return redirect('/tasks');
    }
    public function deletetask(){
      DB::table('task_tbl')->where('task_id',$_POST['id'])->update([
        'task_delete' => 1
      ]);
      return redirect('/tasks');
    }
    

    //***** CONTRACT INFORMATION *****//
    public function Contract(){
      $id = session('id');
      $var = DB::table('project_tbl as p')
      ->join('project_info_tbl as pi','p.proj_no','=','pi.proj_no')
      ->join('contract_info_tbl as ci','p.ci_no','=','ci.ci_no')
      ->where('deleted',0)->get();
      $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
      //notification
      $notif = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
      ->where('notif.notif_description', 'not like', '%added a project to you%')
      ->orderBy('notif.notif_date', 'desc')
      ->take(5)->get();

      $notifcount = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
      ->where('notif.notif_admin_status','unview')->count();
      return view('contract',['var' => $var,'empPic'=>$empPic,'id'=>$id,'notif'=>$notif,'notifcount'=>$notifcount]);
    }
    
    public function getContract(Request $req){
      $type = DB::table('task_tbl')->join('phase_tbl','task_tbl.phase_id','=','phase_tbl.phase_id')->where('task_tbl.task_id',$req->id)->get();
      return response()->json($type);
    }
    public function editContract(){
      DB::table('task_tbl')->where('task_id',$_POST['id'])->update([
        'task_item_no' => $_POST['task_item_no'],
        'task_description' => $_POST['task_description'],
        'phase_id' => $_POST['task_phase'],
        'task_type' => $_POST['task_type'],
        'task_unit' => $_POST['plan_unit'],
        'task_unit_cost' => $_POST['plan_unit_cost'],
      ]);
      return redirect('/tasks');
    }
    
    public function deleteContract(){
      DB::table('task_tbl')->where('task_id',$_POST['id'])->update([
        'task_delete' => 1
      ]);
      return redirect('/tasks');
    }
    

      //***** EQUIPMENT LIST *****//
    public function TruckCategory(){
      $id = session('id');
      $var = DB::table('equipment_category')->get();
      $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();

         //notification
      $notif = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
      ->where('notif.notif_description', 'not like', '%added a project to you%')
      ->orderBy('notif.notif_date', 'desc')
      ->take(5)->get();

      $notifcount = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
      ->where('notif.notif_admin_status','unview')->count();
      
      return view('truck_category',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount,'var' => $var,'empPic'=>$empPic]);
    }
    public function addTruckCategory(){
      DB::table('equipment_category')->insert([
        'ec_category' => $_POST['ec_category']
      ]);
      return redirect('/truck_category');
    }
    public function getTruckCategory(Request $req){
      $type = DB::table('equipment_category')->where('ec_id',$req->id)->get();
      return response()->json($type);
    }
    public function editTruckCategory(){
      DB::table('equipment_category')->where('ec_id',$_POST['id'])->update([
        'ec_category' => $_POST['ec_category']
      ]);
      return redirect('/truck_category');
    }
    public function deleteTruckCategory(){
      DB::table('equipment_category')->where('ec_id',$_POST['id'])-> delete();
      return redirect('/truck_category');
    }

        //***** EQUIPMRNT Stock *****//
    public function EquipmentCategory(){
      $id = session('id');
      $var = DB::select('SELECT count(CASE WHEN ei_status = "Available" Then 1 END) as "Available",
        count(CASE WHEN ei_status = "Deployed" Then 1 END) as "Deployed",
        count(CASE WHEN ei_status = "Defective" Then 1 END) as "Defective", ec_quantity, ec_category, ec.ec_id as "id"
        FROM `equipment_category` as ec
        JOIN `equipment_info_tbl` as ei ON ec.ec_id = ei.ec_id
        Group By ec_category,ec_quantity,ec.ec_id');

      $list = DB::table('equipment_category')->get();
      $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
      return view('equipment',['var' => $var,'list' => $list,'empPic'=>$empPic]);
    }
    public function addEquipment(){
      $id = session('id');
      $stock = DB::table('equipment_category')
      ->join('equipment_info_tbl','equipment_category.ec_id','=','equipment_info_tbl.ec_id')
      ->get();
      $list = DB::table('equipment_category')->get();
      $list2 = DB::table('equipment_category')->get();
      $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();

            //notification
      $notif = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
      ->where('notif.notif_description', 'not like', '%added a project to you%')
      ->orderBy('notif.notif_date', 'desc')
      ->take(5)->get();

      $notifcount = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
      ->where('notif.notif_admin_status','unview')->count();
      
      return view('equipment_add',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount,'stock' => $stock,'list' => $list,'list2' => $list2,'empPic'=>$empPic]);
    }
    public function addEquipmentInfo(){
      $this->validate(request(),[
        'product-name' => 'required',
        'brand' => 'required',
        'model' => 'required',
        'quantity' => 'required',
        'capacity' => 'required'
      ]);
      if($_POST['inspection-date'] == '' || $_POST['inspection-until'] == ''){
        $inspect_date = '1111-11-11';
        $inspect_end = '1111-11-11';
      }else{
        $inspect_date = $_POST['inspection-date'];
        $inspect_end = $_POST['inspection-until'];
      }//if else
      DB::table('equipment_info_tbl')->insert([
        'ec_id' => $_POST['product-name'],
        'ei_manufacturer' => $_POST['brand'],
        'ei_serial_model_plate' => $_POST['model'],
        'ei_status' => 'Available',
        'ei_capacity_qty' => $_POST['quantity'],
        'ei_capacity_unit' => $_POST['capacity'],
        'ei_inspection_date' => $inspect_date,
        'ei_inspection_valid_until' => $inspect_end,
      ]);
      DB::table('equipment_category')
      ->where('ec_id',$_POST['product-name'])->update([
        'ec_quantity' => DB::raw('ec_quantity+1')
      ]);
      return redirect('/equipment_add');
    }
    public function getEquipmentInfo(Request $req){
      $type = DB::table('equipment_info_tbl')->where('ei_id',$req->id)->get();
      return response()->json($type);
    }
    public function editEquipmentInfo(){
      $this->validate(request(),[
        'product-name' => 'required',
        'brand' => 'required',
        'model' => 'required',
        'status' => 'required',
        'quantity' => 'required',
        'capacity' => 'required'
      ]);
      if($_POST['inspection-date'] == '' || $_POST['inspection-until'] == ''){
        $inspect_date = '1111-11-11';
        $inspect_end = '1111-11-11';
      }else{
        $inspect_date = $_POST['inspection-date'];
        $inspect_end = $_POST['inspection-until'];
      }
      DB::table('equipment_info_tbl')->where('ei_id',$_POST['id'])->update([
        'ec_id' => $_POST['product-name'],
        'ei_manufacturer' => $_POST['brand'],
        'ei_serial_model_plate' => $_POST['model'],
        'ei_status' => $_POST['status'],
        'ei_capacity_qty' => $_POST['quantity'],
        'ei_capacity_unit' => $_POST['capacity'],
        'ei_inspection_date' => $inspect_date,
        'ei_inspection_valid_until' => $inspect_end,
      ]);
      return redirect('/equipment_add');
    }
    public function deleteEquipmentInfo(){
      $qty = DB::table('equipment_category as ec')
      ->join('equipment_info_tbl as ei','ei.ec_id','=','ec.ec_id')
      ->where('ei_id',$_POST['id'])->get();
      foreach($qty as $qty){
        $id=$qty->ec_id;
      }//foreach
      DB::table('equipment_info_tbl')->where('ei_id',$_POST['id'])-> delete();
      DB::table('equipment_category')
      ->where('ec_id',$id)->update([
        'ec_quantity' => DB::raw('ec_quantity-1')
      ]);
      return redirect('/equipment_add');
    }//deleteequipmentinfo
    public function EquipmentDep(){
      $id = session('id');
      $var = DB::select('SELECT count(CASE WHEN ei_status = "Deployed" Then 1 END) as "Deployed",
        count(CASE WHEN ei_status = "Maintenace" Then 1 END) as "Maintenance",
        count(CASE WHEN ei_status = "Defective" Then 1 END) as "Defective", pr.proj_no, pi_title
        FROM `equipment_info_tbl` as ei
        JOIN `equipment_deployed_tbl` as ed ON ed.ei_id = ei.ei_id
        JOIN `project_tbl` as pr ON pr.proj_no = ed.proj_no
        JOIN `project_info_tbl` as pi ON pi.proj_no = pr.proj_no
        WHERE deleted = 0
        Group By pr.proj_no,pi_title');

      $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();

          //notification
      $notif = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
      ->where('notif.notif_description', 'not like', '%added a project to you%')
      ->orderBy('notif.notif_date', 'desc')
      ->take(5)->get();

      $notifcount = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
      ->where('notif.notif_admin_status','unview')->count();

      return view('equipment_dep',['var'=>$var,'id' => $id, 'notif' => $notif, 'notifcount' => $notifcount, 'empPic'=>$empPic]);
    }//equipment_dep
    public function EquipmentDepView(){
      $id = session('id');
      $task = DB::table('project_tbl as pr')
      ->join('project_info_tbl as pi','pi.proj_no','=','pr.proj_no')
      ->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')
      ->join('contract_bill_tbl','contract_bill_tbl.cb_id','=','contract_info_tbl.cb_id')
      ->join('project_task_tbl as pt','pr.proj_no','=','pt.proj_no')
      ->join('task_tbl','task_tbl.task_id','=','pt.task_id')
      ->where('pr.proj_no',$_GET['id'])->get();

      $fin = DB::table('project_tbl as pr')
      ->join('project_info_tbl as pi','pi.proj_no','=','pr.proj_no')
      ->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')
      ->join('employee_tbl','pi.emp_id','=','employee_tbl.emp_id')
      ->join('contract_bill_tbl','contract_bill_tbl.cb_id','=','contract_info_tbl.cb_id')
      ->where('pr.proj_no',$_GET['id'])->get();

      $equipdep = DB::table('equipment_deployed_tbl as ed')->where('ed.proj_no',$_GET['id'])
      ->join('equipment_info_tbl as ei','ei.ei_id','=','ed.ei_id')
      ->join('equipment_category as ec','ec.ec_id','=','ei.ec_id')->get();
      $equipreq = DB::table('equipment_deployed_tbl as ed')->where('ed.proj_no',$_GET['id'])
      ->join('equipment_jobrequest_tbl as ejr','ejr.ed_id','=','ed.ed_id')
      ->join('req_items_tbl as ri','ri.ejr_no','=','ejr.ejr_no')->get();


      $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();

         //notification
      $notif = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
      ->orderBy('notif.notif_date', 'desc')
      ->take(5)->get();

      $notifcount = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
      ->where('notif.notif_admin_status','unview')->count();

      return view('equipment_dep_detail',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount, 'fin' => $fin, 'equipdep'=>$equipdep, 'equipreq'=>$equipreq, 'task' => $task,'empPic'=>$empPic]);
    }
    public function ejrDetail(Request $req){
      $type = DB::table('equipment_info_tbl as ei')
      ->join('equipment_deployed_tbl as ed','ed.ei_id','=','ei.ei_id')
      ->join('equipment_jobrequest_tbl as ejr','ejr.ed_id','=','ed.ed_id')
      ->join('req_items_tbl as ri','ri.ejr_no','=','ejr.ejr_no')
      ->join('equip_trial as et','et.ejr_no','=','ejr.ejr_no')
      ->where('ejr.ejr_no',$req->id)->get();
      return response()->json($type);
    }

//***** PROJECT_ADD *****//
    public function Projectadd(){
      $id = session('id');
      $promanager = DB::table('employee_tbl')->join('users','employee_tbl.emp_id','=','users.emp_id')->where([
        ['emp_status', '=', '0'],
        ['el_position', 'Project Manager'],
      ])->get();
      $plan = DB::table('task_tbl')
      ->where('task_tbl.task_delete',0)
      ->orderBy('phase_id')
      ->orderBy('task_item_no')->get();
      $equipcat = DB::table('equipment_category')->where('ec_quantity','>','0')->get();
      $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();

       //notification
      $notif = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
      ->where('notif.notif_description', 'not like', '%added a project to you%')
      ->orderBy('notif.notif_date', 'desc')
      ->take(5)->get();

      $notifcount = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
      ->where('notif.notif_admin_status','unview')->count();

      $company = DB::table('client_tbl')
      ->where('client_tbl.cl_delete',0)->get();

      $client = DB::table('client_rep_tbl')
      ->where('cr_delete',0)->get();

      return view('project_add',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount, 'promanager' => $promanager,'plan' => $plan,'equipcat' => $equipcat,'empPic'=>$empPic,'company'=>$company, 'client'=>$client]);

      //return view('index',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount, 'promanager' => $promanager,'plan' => $plan,'equipcat' => $equipcat,'empPic'=>$empPic, 'client'=>$client,'company'=>$company]);
    }

    public function EquipmentPending(){
      $ecid = $_POST['ec_id'];
      echo "hey".$ecid;
      $qty = $_POST['quantity'];
      for ($x = 0; $x < count($ecid) ; $x++) {
        $query = 'SELECT  ec_id, ei_status 
        FROM `equipment_info_tbl`  
        WHERE ec_id = '.$ecid.' AND ei_status = "Available"
        ORDER BY ei_id ASC
        LIMIT '.$qty.'';
        DB::select($query)->update([
          'ei_status' => 'Pending',
        ]);//DB
      }//for
      return back();
    }

    public function getCompanyDetails(Request $req){
      $type = DB::table('client_tbl')->join('client_rep_tbl as cr','cr.cl_no','=','client_tbl.cl_no')
      ->where('client_tbl.cl_no',$req->cl_no)->get();
      return response()->json($type);
    }

    public function getClientDetails(Request $req){
      $type = DB::table('client_rep_tbl')->where('cr_no',$req->cr_no)->get();
      return response()->json($type);
    }

    public function getEquipList(Request $req){
      $query = 'SELECT DISTINCT ei_capacity_qty, ei_capacity_unit, ec_category 
      FROM `equipment_info_tbl` as ei
      JOIN `equipment_category` as ec ON ei.ec_id = ec.ec_id 
      WHERE ei.ec_id = '.$req->equiptype_id.' AND ei_status = "Available"';
      $type = DB::select($query);
      //$type = DB::table('equipment_info_tbl')->distinct()->select('ei_capacity_qty,ei_capacity_unit')->where('ec_id',$req->equiptype_id)->get();
      return response()->json($type);
    }

    public function getEquipDetails(Request $req){
      $query = 'SELECT COUNT(ei_capacity_qty) as "count",ec.ec_id, ec_category 
      FROM `equipment_info_tbl` as ei
      JOIN `equipment_category` as ec ON ei.ec_id = ec.ec_id
      WHERE ec.ec_id = '.$req->ec_id.'  AND ei_status = "Available" AND 
      CONCAT(ei_capacity_qty," ",ei_capacity_unit) = "'.$req->capacity.'"
      GROUP BY ec_id, ec_category';
      $type = DB::select($query);
      return response()->json($type);
    }

    public function getTaskDetails(Request $req){
      $type = DB::table('task_tbl')->where('task_id',$req->task_id)
      ->where('task_delete',0)->get();
      return response()->json($type);
    }

    public function addproject(){
    /*$this->validate(request(),[
          'company-name' => 'required|max:100',
          'company-email' => 'required',
          'company-phone' => 'required|min:5',
          'company-address' => 'required|max:500',
          'client_fname' => 'required|max:50',
          'client_lname' => 'required|max:50',
          'client_address' => 'required|max:200',
          'client_email' => 'required',
          'client_phone' => 'required|min:5',
          'client_position' => 'required',
          'contract-total' => 'required',
          'contract-title' => 'required|max:500',
          'contract-date' => 'required',
          'contract-signedby' => 'required|max:100',
          'contract-type' => 'required',
          'project-start-date' => 'required',
          'project-end-date' => 'required',
          'start_date' => 'required',
          'total_days' => 'required',
          'project-name' => 'required|max:200',
          'project-desc' => 'required|max:500',
          'project-manager' => 'required',
          'construction-site' => 'required|max:200',
          'floor-no' => 'required',
          'floor-area' => 'required',
          'road-length' => 'required',
          'road-type' => 'required',
          'project-start-date' => 'required',
          'project-end-date' => 'required',
        ]);*/
        $cidesc = "";
        $phaseid = 0;
        $cb_total = 0;
        $task_cost = 0;
        $pt_percentage = 0;
        $existCompany = $_POST['company'];

        if($existCompany == "others"){
          $cl_no = DB::table('client_tbl')->insertGetId([
            'cl_company' => $_POST['company-name'],
            'cl_email' => $_POST['company-email'],
            'cl_contact' => $_POST['company-phone'],
            'cl_address' => $_POST['company-address'],
            ], 'cl_no');//cl
          DB::table('client_rep_tbl')->insert([
            'cr_first_name' => $_POST['client-name'],
            'cr_email' => $_POST['client-email'],
            'cr_contact' => $_POST['client-phone'],
            'cr_position' => $_POST['client-position'],
            'cl_no' => $cl_no,
                  ]);//DB
        }else{
          $cl_no = $existCompany;
        }// if else exist
        $cb_id = DB::table('contract_bill_tbl')->insertGetId([
          'cb_total' => $_POST['contract-total'],
          'cb_paid' => $_POST['contract-paid'],
          'cb_budget' => $_POST['contract-total'],
          'cb_budget_left' => $_POST['contract-total'],
          'cb_balance' => $_POST['contract-balance'],
          'cb_delete' => 0,
    ], 'cb_id');//DB
        $ci_no = DB::table('contract_info_tbl')->insertGetId([
          'ci_date' => $_POST['contract-date'],
          'cl_no' => $cl_no,
          'ci_desc' => $_POST['contract-type'],
          'cb_id' => $cb_id,
          'ci_delete' => 0,
    ], 'ci_no');//DB
        $proj_no = DB::table('project_tbl')->insertGetId([
          'proj_start_date' => $_POST['project-start-date'],
          'proj_end_date' => $_POST['project-end-date'],
          'proj_created_date' => date_create('now'),
          'proj_complete_date' => date_create('now'),
          'ci_no' => $ci_no,
    ], 'proj_no');//DB
        DB::table('proj_percentage_history_tbl')->insert([
          'proj_no' => $proj_no,
          'pph_percentage_added' => 0,
          'pph_percentage' => 0,
          'pph_date' => $_POST['project-start-date'],
          'pph_delete' => 0,
    ]);//DB
        DB::table('payment_tbl')->insert([
          'payment_refno' => 'PYMNT'.time(),
          'payment_amount' => $_POST['contract-paid'],
          'payment_date' => date_create('now'),
          'proj_no' => $proj_no,
          'payment_delete' => 0,
	]);//DB
        DB::table('invoice_tbl')->insert([
          'invoice_no' => '0',
          'invoice_date' => date_create('now'),
          'invoice_due' => date_create('now'),
          'invoice_amount' => $_POST['contract-paid'],
          'proj_percentage' => 15,
          'proj_accpercentage' => 15,
          'proj_no' => $proj_no,
          'invoice_status' =>'Paid',
          'invoice_delete' => 0,
    ]);//insert invoice_tbl
	//*/
        $nophase = $_POST['planphase'];
        $planid = $_POST['planid'];
        $planquantity = $_POST['planquantity'];
        $planprice = $_POST['planprice'];
        for ($x = 0; $x < count($nophase) ; $x++) {
          //echo '11111COUNT $planid ='.$planid[$x].' nophase ='.$nophase[$x].' $x='.$x.' < $count='.count($nophase).'COUNT11111<br>';
          if($x == count($nophase)-1){
            $pp_id = DB::table('project_phase_tbl')->insertGetId([
              'phase_id' => $nophase[$x],
              'proj_no' => $proj_no,
              'pp_start_date' => $_POST['project-start-date'],
              'pp_end_date' => '1111-11-11',
              'pp_delete' => 0,
            ],'pp_id');//DB
            //echo '<br>!!!!!LAST you SAVE phase='.$nophase[$x].' $x='.$x.'LAST!!!!!<br>';
            for ($p = 0; $p < count($nophase) ; $p++) {
              if ($nophase[$x] == $nophase[$p]){
                $bill = DB::table('contract_bill_tbl as cb')->where('cb_id',$cb_id)->get();
                $task_cost = $planprice[$p];
                foreach($bill as $bill){
                  $ptp = $task_cost / $bill->cb_total;
                  $pt_percentage = $ptp * 100;
                }//foreach
                DB::table('project_task_tbl')->insert([
                  'task_id' => $planid[$p],
                  'pt_qty' => intval(preg_replace('/[^\d.]/', '', $planquantity[$p])),
                  'pt_total_cost' => intval(preg_replace('/[^\d.]/', '', $planprice[$p])),
                  'pt_percentage' => 0,
                  'pt_proj_percentage' => $pt_percentage,
                  'proj_no' => $proj_no,
                  'pp_id' => $pp_id,
                  'pt_start_date' => $_POST['project-start-date'],
                  'pt_end_date' =>  '1111-11-11',
                  'pt_date_completed' => $_POST['project-start-date'],
                ]);//DB
                //echo '<br>!!!!!task id save='.$planid[$p].' $x='.$nophase[$x].'== $p='.$nophase[$p].'!!!!!<br>';
              }//if
            }//for    
          }//if it is last
          for($y = $x+1; $y<count($nophase); $y++){
            //echo '22222COUNT $y='.$y.'= $x='.$x.' < $count='.count($nophase).'$nophase['.$y.']='.$nophase[$y].'$nophase['.$x.']='.$nophase[$x].'COUNT22222<br>';
            if($nophase[$x] == $nophase[$y]){
                //echo '<br>SKIP $x['.$x.']='.$nophase[$x].'== $y['.$y.']='.$nophase[$y].'<br>';
              $y = count($nophase);
                //echo 'exit for $y='.$y.'<br><br>';
            }else{
                //echo '<br>SKIP $x['.$x.']='.$nophase[$x].'!= $y['.$y.']='.$nophase[$y].'<br>';
              if($y == count($nophase)-1){
                $pp_id = DB::table('project_phase_tbl')->insertGetId([
                  'phase_id' => $nophase[$x],
                  'proj_no' => $proj_no,
                  'pp_start_date' => $_POST['project-start-date'],
                  'pp_end_date' => '1111-11-11',
                  'pp_delete' => 0,
                  ],'pp_id');//DB
                  //echo '<br>!!!!!you SAVE phase='.$nophase[$x].' $x='.$x.'!!!!!<br>';
                for ($p = 0; $p < count($nophase) ; $p++) {
                  if ($nophase[$x] == $nophase[$p]){
                    $bill = DB::table('contract_bill_tbl as cb')->where('cb_id',$cb_id)->get();
                    $task_cost = $planprice[$p];
                    foreach($bill as $bill){
                      $ptp = $task_cost / $bill->cb_total;
                      $pt_percentage = $ptp * 100;
                      }//foreach
                      DB::table('project_task_tbl')->insert([
                        'task_id' => $planid[$p],
                        'pt_qty' => $planquantity[$p],
                        'pt_total_cost' => $planprice[$p],
                        'pt_percentage' => 0,
                        'pt_proj_percentage' => $pt_percentage,
                        'proj_no' => $proj_no,
                        'pp_id' => $pp_id,
                        'pt_start_date' => $_POST['project-start-date'],
                        'pt_end_date' =>  '1111-11-11',
                        'pt_date_completed' => $_POST['project-start-date'],
                      ]);//DB
                      //echo '<br>!!!!!task id save='.$planid[$p].' $x='.$nophase[$x].'== $p='.$nophase[$p].'!!!!!<br>';
                    }//if
                  }//for
                }//if not equal
                //echo '$y['.$y.'] != $count['.count($nophase).']<br><br>';
              }//if else empty
          }//for y
        }//for x

        $eiid = $_POST['ei_id'];
        $start_date = $_POST['start_date'];
        $total_days = $_POST['total_days'];
        for ($x = 0; $x < count($eiid) ; $x++) {
          DB::table('equipment_deployed_tbl')->insert([
            'ed_date' => $_POST['project-start-date'],
            'ei_id' => $eiid[$x],
            'proj_no' => $proj_no,
            'ed_start_date' => $start_date[$x],
            'ed_total_days' => $total_days[$x],
            'ed_delete' => 0,
      ]);//DB
          DB::table('equipment_info_tbl')->where('ei_id',$eiid[$x])->update([
            'ei_status' => 'Deployed',
      ]);//DB
    }//for

    DB::table('project_info_tbl')->insert([
      'pi_title' => $_POST['project-name'],
      'pi_description' => $_POST['project-desc'],
      'emp_id' => $_POST['project-manager'],
      'pi_construction_site' => $_POST['construction-site'],
      'pi_floor_no' => $_POST['floor-no'],
      'pi_floor_area' => $_POST['floor-area'],
      'pi_road_length' => $_POST['road-length'],
      'pi_road_type' => $_POST['road-type'],
      'proj_no' => $proj_no,
    ]);//DB


    $id = session('id');
    $empp = DB::table('employee_tbl as emp')->where('emp.emp_id',$id)
    ->join('project_info_tbl as pi','pi.emp_id','=','emp.emp_id')->get();
    foreach($empp as $empp){
      DB::table('notification_tbl')->insert([
        'notif_description' => $empp->emp_first_name." ".$empp->emp_last_name." added a project to you. Click here to show details",
        'proj_no' => $proj_no,
        'notif_from' => $id,
        'notif_to' => $_POST['project-manager'],
        'notif_date' => date_create('now'),
        'notif_url' => '/project_edit?id='.$proj_no,
        'notif_pm_url' => '/PM_project_edit?id='.$proj_no,
        'notif_icon' => 'addprojtoyou.png',
      ]);

      $text = "You need to update project phase and project task's start date and end date. (".$empp->pi_title.")";

      DB::table('notification_tbl')->insert([
        'notif_description' => $text,
        'proj_no' => $proj_no,
        'notif_from' => $id,
        'notif_to' => $_POST['project-manager'],
        'notif_date' => date_create('now'),
        'notif_url' => '/project_edit?id='.proj_no,
        'notif_pm_url' => '/PM_project_edit?id='.$proj_no,
        'notif_icon' => 'addprojtoyou.png',
      ]);
      
    }


    echo '<script language="javascript">';
    echo 'alert("Project Successfully Added!")';
    echo '</script>';
    return redirect('/project');
  }//public
  
  /*DELETE PROJECT*/
  public function deleteproject(){
    /*$qty = DB::table('equipment_category as ec')
      ->join('equipment_info_tbl as ei','ei.ec_id','=','ec.ec_id')
      ->where('ei_id',$_POST['id'])->get();//*/
    //echo 'id='.$_POST['id'];
      $proj_no=$_POST['id'];

      $project = DB::table('project_tbl as proj')
      ->join('contract_info_tbl as ci','ci.ci_no','=','proj.ci_no')
      ->join('contract_bill_tbl as cb','cb.cb_id','=','ci.cb_id')
      ->join('client_tbl as cl','cl.cl_no','=','ci.cl_no')
      ->join('client_rep_tbl as cr','cr.cl_no','=','cl.cl_no')
      ->where('proj_no',$proj_no)->get();

      $equipment = DB::table('equipment_deployed_tbl as ed')
      ->join('equipment_info_tbl as ei','ei.ei_id','=','ed.ei_id')
      ->where('proj_no',$proj_no)->get();

      foreach($project as $project){
        $ci_no = $project->ci_no;
        $cb_id = $project->cb_id;
        $cl_no = $project->cl_no;
        $cr_id = $project->cr_id; 
    }//get value
    
    foreach($equipment as $equipment){
      $ed_id = $equipment->ed_id;
      $ei_id = $equipment->ei_id;
    }//get value
    
    DB::table('project_tbl')->where('proj_no',$proj_no)->update([
      'deleted' => 1,
    ]);
   // DB::table('contract_info_tbl')->where('ci_no',$ci_no)->update([
    //  'ci_delete' => 1,
    //]);
    //DB::table('contract_bill_tbl')->where('cb_id',$cb_id)->update([
    //  'cb_delete' => 1
    //]);
    //DB::table('client_tbl')->where('cl_no',$cl_no)->update([
    //  'cl_delete' => 1
    //]);
    //DB::table('client_rep_tbl')->where('cr_id',$cr_id)->update([
    //  'cr_delete' => 1
    //]);
    
    DB::table('equipment_info_tbl')->where('ei_id',$ei_id)->update([
      'ei_status' => 'Available'
    ]);//*/
    
    echo '<script language="javascript">';
    echo 'alert("Project Successfully deleted!")';
    echo '</script>';
    //echo 'projno ='.$proj_no.'...cino ='.$ci_no.'...cbid ='.$cb_id.'...clno ='.$cl_no.'...crid ='.$cr_id.'...eiid ='.$ei_id.'...edid ='.$ed_id;
    
    return redirect('/project');
  }//deleteProject


//***** PROJECT *****//
  public function Project(){
    $id = session('id');
    $var = DB::table('project_tbl')
    ->join('project_info_tbl','project_tbl.proj_no','=','project_info_tbl.proj_no')
    ->join('employee_tbl','project_info_tbl.emp_id','=','employee_tbl.emp_id')
    ->orderBy('project_tbl.proj_created_date', 'desc')
    ->where('project_tbl.deleted',0)->get();
    $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();

     //notification
    $notif = DB::table('notification_tbl as notif')
    ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
    ->where('notif.notif_description', 'not like', '%added a project to you%')
    ->orderBy('notif.notif_date', 'desc')
    ->take(5)->get();

    $notifcount = DB::table('notification_tbl as notif')
    ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
    ->where('notif.notif_description', 'not like', '%added%')
    ->where('notif.notif_admin_status','unview')->count();

    return view('project',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount, 'var' => $var,'empPic'=>$empPic]);
  }



  public function ProjectView(){
    $id = session('id');    
    $project = DB::table('project_tbl as pr')->where('pr.proj_no',$_GET['id'])
    ->join('project_info_tbl','pr.proj_no','=','project_info_tbl.proj_no')
    ->join('employee_tbl','project_info_tbl.emp_id','=','employee_tbl.emp_id')
    ->join('contract_info_tbl','contract_info_tbl.ci_no','=','pr.ci_no')
    ->join('contract_bill_tbl','contract_info_tbl.cb_id','=','contract_bill_tbl.cb_id')
    ->join('client_tbl','contract_info_tbl.cl_no','=','client_tbl.cl_no');

    $proj = $project->get();
    foreach($proj as $value) {
     $clno = $value->cl_no;
   }

   $client = DB::table('client_tbl')->where('client_tbl.cl_no',$clno)
   ->join('client_rep_tbl','client_rep_tbl.cl_no','=','client_tbl.cl_no')->get();
   $proj = DB::table('project_tbl as pr')
   ->join('project_info_tbl','pr.proj_no','=','project_info_tbl.proj_no')
   ->join('employee_tbl','project_info_tbl.emp_id','=','employee_tbl.emp_id')
   ->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')
   ->join('contract_bill_tbl','contract_bill_tbl.cb_id','=','contract_info_tbl.cb_id')
   ->where('pr.proj_no',$_GET['id'])->get();
   $equipdep = DB::table('equipment_deployed_tbl as ed')->where('ed.proj_no',$_GET['id'])
   ->join('equipment_info_tbl as ei','ei.ei_id','=','ed.ei_id')->get();
   $plan = DB::table('project_tbl as pr')
   ->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')
   ->join('contract_bill_tbl','contract_bill_tbl.cb_id','=','contract_info_tbl.cb_id')
   ->join('project_task_tbl as pt','pr.proj_no','=','pt.proj_no')
   ->join('task_tbl','task_tbl.task_id','=','pt.task_id')
   ->where('pr.proj_no',$_GET['id'])->get();
   $task = DB::table('project_tbl as pr')
   ->join('project_task_tbl as pt','pr.proj_no','=','pt.proj_no')
   ->join('task_tbl','task_tbl.task_id','=','pt.task_id')
   ->join('phase_tbl','phase_tbl.phase_id','=','task_tbl.phase_id')
   ->where('pr.proj_no',$_GET['id'])->get();
   $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();

  //notification
   $notif = DB::table('notification_tbl as notif')
   ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
   ->orderBy('notif.notif_date', 'desc')
   ->take(5)->get();

   $notifcount = DB::table('notification_tbl as notif')
   ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
   ->where('notif.notif_admin_status','unview')->count();

   return view('project_detail',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount, 'proj' => $proj, 'client' => $client, 'equipdep' => $equipdep,'plan' => $plan, 'task' => $task,'empPic'=>$empPic]);
 }



//***** PROJECT_EDIT *****//
 public function ProjectEdit(){
  $id = session('id');
  $currentexpense = 0;
  $expense = 0;
  $project = DB::table('project_tbl as pr')->where('pr.proj_no',$_GET['id'])
  ->join('project_info_tbl','pr.proj_no','=','project_info_tbl.proj_no')
  ->join('employee_tbl','project_info_tbl.emp_id','=','employee_tbl.emp_id')
  ->join('contract_info_tbl','contract_info_tbl.ci_no','=','pr.ci_no')
  ->join('contract_bill_tbl','contract_info_tbl.cb_id','=','contract_bill_tbl.cb_id')
  ->join('client_tbl','contract_info_tbl.cl_no','=','client_tbl.cl_no');

  $proj = $project->get();
  foreach($proj as $value) {
   $clno = $value->cl_no;
 }

 $client = DB::table('client_tbl')->where('client_tbl.cl_no',$clno)
 ->join('client_rep_tbl','client_rep_tbl.cl_no','=','client_tbl.cl_no')->get();
 $proj = DB::table('project_tbl as pr')
 ->join('project_info_tbl','pr.proj_no','=','project_info_tbl.proj_no')
 ->join('employee_tbl','project_info_tbl.emp_id','=','employee_tbl.emp_id')
 ->join('users','users.emp_id','=','employee_tbl.emp_id')
 ->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')
 ->join('contract_bill_tbl','contract_bill_tbl.cb_id','=','contract_info_tbl.cb_id')
 ->where('pr.proj_no',$_GET['id'])->get();
 $contract = DB::table('project_tbl as pr')
 ->join('contract_info_tbl as ci','pr.ci_no','=','ci.ci_no')
 ->join('contract_bill_tbl as cb','cb.cb_id','=','ci.cb_id')
 ->where('pr.proj_no',$_GET['id'])->get();
 $equipdep = DB::table('equipment_deployed_tbl as ed')->where('ed.proj_no',$_GET['id'])
 ->join('equipment_info_tbl as ei','ei.ei_id','=','ed.ei_id')->get();
 $plan = DB::table('project_tbl as pr')
 ->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')
 ->join('contract_bill_tbl','contract_bill_tbl.cb_id','=','contract_info_tbl.cb_id')
 ->join('project_task_tbl as pt','pr.proj_no','=','pt.proj_no')
 ->join('task_tbl','task_tbl.task_id','=','pt.task_id')
 ->where('pr.proj_no',$_GET['id'])->get();
 $ter = DB::table('project_tbl as pr')
 ->join('timeext_request_tbl as ter','ter.proj_no','=','pr.proj_no')
 ->where('pr.proj_no',$_GET['id'])->get();
 $task = DB::table('project_tbl as pr')
 ->join('project_task_tbl as pt','pr.proj_no','=','pt.proj_no')
 ->join('task_tbl','task_tbl.task_id','=','pt.task_id')
 ->join('project_phase_tbl as pp','pt.pp_id','=','pp.pp_id')
 ->join('project_info_tbl as pi','pi.proj_no','=','pr.proj_no')
 ->where('pr.proj_no',$_GET['id'])
 ->orderBy('pp.pp_id')
 ->orderBy('task_tbl.task_item_no')->get();
 $phase = DB::table('project_phase_tbl as pp')
 ->join('phase_tbl','pp.phase_id','=','phase_tbl.phase_id')
 ->where('pp.proj_no',$_GET['id'])->get();
 $invoice = DB::table('project_tbl as pr')
 ->join('project_info_tbl as pi','pi.proj_no','=','pr.proj_no')
 ->join('invoice_tbl as in','in.proj_no','=','pr.proj_no')
 ->where('in.proj_no',$_GET['id'])
 ->where('in.invoice_no','<>','0')
 ->where('in.invoice_delete','0')->get();
 $payment= DB::table('project_tbl as pr')
 ->join('project_info_tbl as pi','pi.proj_no','=','pr.proj_no')
 ->join('payment_tbl as pay','pay.proj_no','=','pr.proj_no')
 ->where('pay.proj_no',$_GET['id'])->get();
 $nvc = DB::table('project_tbl as pr')
 ->join('invoice_tbl','invoice_tbl.proj_no','=','pr.proj_no')
 ->where('invoice_tbl.proj_no',$_GET['id'])
 ->where('invoice_tbl.invoice_no','0')->get();  
 $PM = DB::table('employee_tbl as emp')
 ->join('users','users.emp_id','=','emp.emp_id')
 ->where('emp_status',0)
 ->where('el_position','Project Manager')->get();
 $equipdep = DB::table('equipment_deployed_tbl as ed')->where('ed.proj_no',$_GET['id'])
 ->join('equipment_info_tbl as ei','ei.ei_id','=','ed.ei_id')
 ->join('equipment_category as ec','ec.ec_id','=','ei.ec_id')->get();
 $equipreq = DB::table('equipment_deployed_tbl as ed')->where('ed.proj_no',$_GET['id'])
 ->join('equipment_jobrequest_tbl as ejr','ejr.ed_id','=','ed.ed_id')
 ->join('req_items_tbl as ri','ri.ejr_no','=','ejr.ejr_no')->get();
 $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
 
   //notification for admin
 $notif = DB::table('notification_tbl as notif')
 ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
 ->where('notif.notif_description', 'not like', '%added a project to you%')
 ->orderBy('notif.notif_date', 'desc')
 ->take(5)->get();
 
 $notifcount = DB::table('notification_tbl as notif')
 ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
 ->where('notif.notif_admin_status','unview')->count();
 
 return view('project_edit',['id' => $id, 'payment' => $payment, 'notif' => $notif, 'notifcount' => $notifcount, 'nvc' => $nvc, 'invoice' => $invoice, 'proj' => $proj, 'client' => $client, 'equipdep' => $equipdep, 'plan' => $plan, 'task' => $task, 'PM' => $PM, 'phase' => $phase, 'contract' => $contract, 'ter' => $ter,'equipdep'=>$equipdep,'equipreq'=>$equipreq,'empPic'=>$empPic]);
}

public function editproject(){
  $id = session('id');
  $projman;
  $newprojmanid;
  $empname = '';
  $newprojmanname = '';

    //get new pm
  $newprojmanid = $_POST['project-manager'];
  $empid = DB::table('employee_tbl')
  ->where('emp_id',$newprojmanid)->get();
  foreach ($empid as $empid) {
    $newprojmanname = $empid->emp_first_name.' '.$empid->emp_last_name;
  }

    //get the current pm
  $empid = DB::table('project_tbl')
  ->join('project_info_tbl as pi','project_tbl.proj_no','=','pi.proj_no')
  ->where('project_tbl.proj_no',$_POST['project-id'])->get();
  foreach ($empid as $empid) {
    $projman = $empid->emp_id;
  }

    //get employee who update record
  $empid = DB::table('employee_tbl')
  ->where('emp_id',$id)->get();
  foreach ($empid as $empid) {
    $empname = $empid->emp_first_name.' '.$empid->emp_last_name;
  }

    //compare new-current pm
  if ($projman != $newprojmanid)
  {
      //insert recent activity
    DB::table('recent_activity_table')->insert([
      'ra_description' => $empname.' assigned '.$newprojmanname.' as new Project Manager for project '.$_POST['project-name'].'.',
      'proj_no' => $_POST['project-id'],
      'emp_id' => $id,
    ]);
      //insert notification
    DB::table('notification_tbl')->insert([
      'notif_description' => $empname." added a project to you. Click here to show details",
      'proj_no' => $_POST['project-id'],
      'notif_from' => $id,
      'notif_to' => $_POST['project-manager'],
      'notif_date' => date_create('now'),
      'notif_url' => '/project_edit?id='.$_POST['project-id'],
      'notif_pm_url' => '/PM_project_edit?id='.$_POST['project-id'],
      'notif_icon' => 'addprojtoyou.png',
    ]);
  }

  DB::table('project_tbl')->join('project_info_tbl as pi','project_tbl.proj_no','=','pi.proj_no')->where('project_tbl.proj_no',$_POST['project-id'])->update([
    'pi_title' => $_POST['project-name'],
    'emp_id' => $_POST['project-manager'],
    'proj_start_date' => $_POST['start'],
    'proj_end_date' => $_POST['end'],
    'pi_construction_site' => $_POST['project-site'],
    'pi_description' => $_POST['project-desc'],
    'pi_floor_no' => $_POST['floor-no'],
    'pi_floor_area' => $_POST['floor-area'],
    'pi_road_length' => $_POST['road-length'],
    'pi_road_type' => $_POST['road-type'],
  ]);

  return back();
}

public function editprojremarks(){
  DB::table('project_tbl')->join('project_info_tbl as pi','project_tbl.proj_no','=','pi.proj_no')->where('project_tbl.proj_no',$_POST['proj_no'])->update([
    'pi_remarks' => $_POST['project-remarks'],
  ]);
  return back();
}

public function PreviewContract(){
  $proj = DB::table('project_tbl as pr')
  ->join('project_info_tbl','pr.proj_no','=','project_info_tbl.proj_no')
  ->join('employee_tbl','project_info_tbl.emp_id','=','employee_tbl.emp_id')
  ->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')
  ->join('contract_bill_tbl','contract_bill_tbl.cb_id','=','contract_info_tbl.cb_id')
  ->where('pr.proj_no',$_GET['id'])->get();
  $client = DB::table('project_tbl as pr')
  ->join('contract_info_tbl as ci','pr.ci_no','=','ci.ci_no')
  ->join('client_tbl as cl','ci.cl_no','=','cl.cl_no')
  ->join('client_rep_tbl as cr','ci.cl_no','=','cr.cl_no')
  ->where('pr.proj_no',$_GET['id'])->get();
  $plan = DB::table('project_tbl as pr')
  ->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')
  ->join('contract_bill_tbl','contract_bill_tbl.cb_id','=','contract_info_tbl.cb_id')
  ->join('project_task_tbl as pt','pr.proj_no','=','pt.proj_no')
  ->join('task_tbl','task_tbl.task_id','=','pt.task_id')
  ->where('pr.proj_no',$_GET['id'])->get();
  view()->share('proj',$proj);
  view()->share('plan',$plan);
  view()->share('client',$client);
  $pdf = PDF::loadView('pdfcontract', compact($proj,$plan,$client));
      // return $pdf->download('invoice.pdf');
  return $pdf->stream("Contract");
}

  //Download Monthly Report
public function MonthlyReport(){
  $proj = DB::table('project_tbl as pr')
  ->join('project_info_tbl','pr.proj_no','=','project_info_tbl.proj_no')
  ->join('employee_tbl','project_info_tbl.emp_id','=','employee_tbl.emp_id')
  ->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')
  ->join('contract_bill_tbl','contract_bill_tbl.cb_id','=','contract_info_tbl.cb_id')
  ->where('pr.proj_no',$_GET['id'])->get();
  $task = DB::table('project_tbl as pr')
  ->join('project_task_tbl as pt','pr.proj_no','=','pt.proj_no')
  ->join('task_tbl','task_tbl.task_id','=','pt.task_id')
  ->join('phase_tbl','phase_tbl.phase_id','=','task_tbl.phase_id')
  ->where('pr.proj_no',$_GET['id'])->get();
  view()->share('proj',$proj);
  view()->share('task',$task);
  $pdf = PDF::loadView('pdfmonthlyreport', compact($proj,$task));
      // return $pdf->download('invoice.pdf');
  return $pdf->stream("Monthly Report");
}

    //get project info for invoice
public function addinvoice(Request $req){
  $type = DB::table('project_tbl as pr')
  ->join('project_info_tbl','pr.proj_no','=','project_info_tbl.proj_no')
  ->join('invoice_tbl as in','in.proj_no','=','pr.proj_no')
  ->where('pr.proj_no',$req->id)->get();
  return response()->json($type);
}

  //view invoice info
public function invoice(){
  $id = session('id');
  $expense = 0;
  $penalty = 0;
  $currentexpense = 0;
  $invoiceper = 0;
  $reqtimeext = 0;
  $req_amount = 0;
  $proj_no = $_POST['proj_no'];
  $invoicedue = $_POST['invoice_due'];
  $proj = DB::table('project_tbl as pr')
  ->join('project_info_tbl','pr.proj_no','=','project_info_tbl.proj_no')
  ->join('employee_tbl','project_info_tbl.emp_id','=','employee_tbl.emp_id')
  ->join('contract_info_tbl as ci','pr.ci_no','=','ci.ci_no')
  ->join('contract_bill_tbl','contract_bill_tbl.cb_id','=','ci.cb_id')
  ->join('client_tbl as cl','cl.cl_no','=','ci.cl_no')
  ->join('client_rep_tbl as cr','cr.cl_no','=','cl.cl_no')
  ->where('pr.proj_no',$proj_no)->get();

  $reqtimeext = DB::table('project_tbl as pr')
  ->join('timeext_request_tbl as tr','pr.proj_no','=','tr.proj_no')
  ->where('tr.proj_no',$proj_no)
  ->where('tr.ter_status','Approved')->get();

  foreach ($reqtimeext as $reqtimeext) {
    $req_amount += $reqtimeext->ter_amount;
  }

  $terno = DB::table('project_tbl as pr')
  ->join('timeext_request_tbl as tr','pr.proj_no','=','tr.proj_no')
  ->where('tr.proj_no',$proj_no)
  ->where('tr.ter_status','Approved')->count();

  $intask = DB::table('project_tbl as pr')
  ->join('project_task_tbl as pt','pr.proj_no','=','pt.proj_no')
  ->where([
    ['pt.proj_no',$proj_no]
  ])->get();

  foreach ($intask as $intask) {
    $expense += $intask->pt_total_cost;
  }

  $qry = 'SELECT * FROM `invoice_tbl`  WHERE proj_no ='.$proj_no.' ORDER BY invoice_id DESC LIMIT 1 ';
  $inper = DB::select($qry);

  foreach ($inper as $inper) {
    $invoiceper = $inper->proj_percentage;
  }

  $invoicetask = DB::table('project_tbl as pr')
  ->join('project_task_tbl as pt','pr.proj_no','=','pt.proj_no')
  ->join('task_tbl','task_tbl.task_id','=','pt.task_id')
  ->where([
    ['pt.proj_no',$proj_no]
  ])->get();
  $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();

       //notification
  $notif = DB::table('notification_tbl as notif')
  ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
  ->orderBy('notif.notif_date', 'desc')
  ->take(5)->get();

  $notifcount = DB::table('notification_tbl as notif')
  ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
  ->where('notif.notif_admin_status','unview')->count();


  return view('invoice',['req_amount' => $req_amount, 'terno' => $terno, 'reqtimeext' => $reqtimeext, 'invoiceper' => $invoiceper, 'expense' => $expense,'invoicedue' => $invoicedue, 'invoicetask' => $invoicetask, 'proj' => $proj,'empPic'=>$empPic,'id'=>$id,'notif'=>$notif,'notifcount'=>$notifcount]);
}

    //save new invoice info
public function saveinvoice(){
  $id = $_POST['proj_no'];
  $currentexpense = 0;
  $invoiceper = 0;
  $accper = 0;    
  $id = $_POST['proj_no'];
  $invoicedue = $_POST['invoice_due'];
  $projper = $_POST['proj_percentage'];

  $qry = 'SELECT * FROM `invoice_tbl`  WHERE proj_no ='.$id.' ORDER BY invoice_id DESC LIMIT 1 ';
  $inper = DB::select($qry);
  foreach ($inper as $inper) {
    $invoiceper = $inper->proj_percentage;
  }

  $accper = $projper - $invoiceper;

  $invoice_id = DB::table('invoice_tbl')->insertGetId([
    'invoice_no' => $_POST['invoice_no'],
    'proj_no' => $_POST['proj_no'],
    'proj_percentage' => $_POST['proj_percentage'],
    'proj_accpercentage' => $accper,
    'invoice_date' => date_create('now'),
    'invoice_due' => $_POST['invoice_due'],
    'invoice_amount' => $_POST['invoice_amount'],
  ],'invoice_id');

  DB::table('invoice_tbl')
  ->where('proj_no',$id)
  ->where('invoice_no','0')->update([
    'invoice_date' => date_create('now'),
    'proj_percentage' => $_POST['proj_percentage'],
  ]);

  $proj = DB::table('project_tbl as pr')
  ->join('project_info_tbl','pr.proj_no','=','project_info_tbl.proj_no')
  ->join('employee_tbl','project_info_tbl.emp_id','=','employee_tbl.emp_id')
  ->join('contract_info_tbl as ci','pr.ci_no','=','ci.ci_no')
  ->join('contract_bill_tbl as cb','cb.cb_id','=','ci.cb_id')
  ->join('client_tbl as cl','cl.cl_no','=','ci.cl_no')
  ->join('client_rep_tbl as cr','cr.cl_no','=','cl.cl_no')
      ->join('invoice_tbl as in','in.proj_no','=','pr.proj_no')//doble yung lumabas
      ->where('pr.proj_no',$id)
      ->where('in.invoice_id',$invoice_id)->get();

      $task = DB::table('project_task_tbl as pt')
      ->join('task_tbl','task_tbl.task_id','=','pt.task_id')
      ->where('pt.proj_no',$id)
      ->where('pt.invoice_id',$invoice_id)->get();
      
      $intask = DB::table('project_tbl as pr')
      ->join('project_task_tbl as pt','pr.proj_no','=','pt.proj_no')
      ->join('task_tbl','task_tbl.task_id','=','pt.task_id')
      ->where('pt.proj_no',$id)->get();

      foreach ($intask as $intask) {
        $currentexpense += $intask->pt_total_cost;
      }
      $expense = $currentexpense;
      view()->share('proj',$proj);
      view()->share('task',$task);
      view()->share('expense',$expense);
      view()->share('invoiceper',$invoiceper);
      view()->share('invoicedue',$invoicedue);
      $pdf = PDF::loadView('pdfinvoice', compact($proj,$task,$expense,$invoiceper,$invoicedue));
          //return $pdf->stream('invoice');
          //return $pdf->download("Invoice".time().".pdf");
      return $pdf->save(public_path().'/files/invoice/'.$_POST['invoice_no'].'.pdf')->download($_POST['invoice_no'].'.pdf');

      return redirect('/project_edit?id='.$_POST['proj_no']);
    }

    public function closeproject(){
      $status = 'Closed';
      DB::table('project_tbl')->where('proj_no',$_GET['id'])->update([
        'proj_status' => $status,
        'proj_complete_date' => date_create('now'),
      ]);
      $proj_no=$_GET['id'];

      $equipment = DB::table('equipment_deployed_tbl as ed')
      ->join('equipment_info_tbl as ei','ei.ei_id','=','ed.ei_id')
      ->where('proj_no',$proj_no)->get();

      foreach($equipment as $equipment){
        $ed_id = $equipment->ed_id;
        $ei_id = $equipment->ei_id;
        }//get value

        DB::table('equipment_info_tbl')->where('ei_id',$ei_id)->update([
          'ei_status' => 'Available'
        ]);//*/

        echo '<script language="javascript">';
        echo 'alert("Project Successfully Closed!")';
        echo '</script>';
        //echo 'projno ='.$proj_no.'...cino ='.$ci_no.'...cbid ='.$cb_id.'...clno ='.$cl_no.'...crid ='.$cr_id.'...eiid ='.$ei_id.'...edid ='.$ed_id;

        return redirect('/project');
      }

      public function editprojinvoice(){
        $recentinstat = "";
        $invoice_amount = 0;
        $invoice = DB::table('invoice_tbl')
        ->where('proj_no',$_POST['proj_no'])
        ->where('invoice_no',$_POST['invoice_no'])->get();
        foreach($invoice as $invoice) {
          $recentinstat = $invoice->invoice_status;
        }
        DB::table('invoice_tbl')
        ->where('proj_no',$_POST['proj_no'])
        ->where('invoice_no',$_POST['invoice_no'])->update([
          'invoice_date' => $_POST['invoice_date'],
          'invoice_due' => $_POST['invoice_due'],
          'invoice_status' => $_POST['invoice_status'],
        ]);
        $image = $_POST['payment_image'];
        if(!empty($image)){ 
          DB::table('invoice_tbl')->where('proj_no',$_POST['proj_no'])->where('invoice_no',$_POST['invoice_no'])->update([
            'invoice_image' => $_POST['payment_image'],
          ]);
        }
        else {
          DB::table('invoice_tbl')->where('proj_no',$_POST['proj_no'])->where('invoice_id',$_POST['invoice_no'])->update([
            'invoice_image' => $_POST['image'],
          ]);
        }
        $payment_status = $_POST['invoice_status']; 
        $proj_no = $_POST['proj_no'];
        $conbill = DB::table('project_tbl as pr')
        ->join('contract_info_tbl as ci','pr.ci_no','=','ci.ci_no')
        ->join('contract_bill_tbl as cb','cb.cb_id','=','ci.cb_id')
        ->where('pr.proj_no',$proj_no)->get();
        foreach($conbill as $conbill) {
          $paid = $conbill->cb_paid;
          $balance = $conbill->cb_balance;
        }
        $invoice = DB::table('invoice_tbl')
        ->where('proj_no',$_POST['proj_no'])
        ->where('invoice_no',$_POST['invoice_no'])->get();
        foreach($invoice as $invoice) {
          $invoice_amount = $invoice->invoice_amount;
        }
        if($payment_status=="Paid" && $recentinstat=="Waiting"){
          $newpaid = $paid + $invoice_amount;
          $newbalance = $balance - $invoice_amount;
          DB::table('project_tbl as pr')
          ->join('contract_info_tbl as ci','pr.ci_no','=','ci.ci_no')
          ->join('contract_bill_tbl as cb','cb.cb_id','=','ci.cb_id')
          ->where('pr.proj_no',$proj_no)->update([
            'cb_paid' => $newpaid,
            'cb_balance' => $newbalance,
          ]);
          DB::table('payment_tbl')->insert([
            'payment_refno' => 'PYMNT'.time(),
            'payment_amount' => $invoice_amount,
            'proj_no' => $proj_no,
            'invoice_id' => $_POST['invoice_no'],
            'payment_date' => date_create('now'),
          ]);
        } else if($payment_status=="Waiting" && $recentinstat=="Paid"){
          $newpaid = $paid - $invoice_amount;
          $newbalance = $balance + $invoice_amount;
          DB::table('project_tbl as pr')
          ->join('contract_info_tbl as ci','pr.ci_no','=','ci.ci_no')
          ->join('contract_bill_tbl as cb','cb.cb_id','=','ci.cb_id')
          ->where('pr.proj_no',$proj_no)->update([
            'cb_paid' => $newpaid,
            'cb_balance' => $newbalance,
          ]);
          DB::table('payment_tbl')->where('invoice_id', $_POST['invoice_no'])->delete();
        } else if ($payment_status=="Waiting" && $recentinstat=="Waiting"){

        } else if ($payment_status=="Waiting" && $recentinstat=="Waiting"){

        } else {}
        
        return back(); 
      }

      public function pdfinvoice(){
        $currentexpense= 0;
        $invoiceper= 0;
        $proj = DB::table('project_tbl as pr')
        ->join('project_info_tbl','pr.proj_no','=','project_info_tbl.proj_no')
        ->join('invoice_tbl','pr.proj_no','=','invoice_tbl.proj_no')
        ->join('employee_tbl','project_info_tbl.emp_id','=','employee_tbl.emp_id')
        ->join('contract_info_tbl as ci','pr.ci_no','=','ci.ci_no')
        ->join('client_tbl as cl','cl.cl_no','=','ci.cl_no')
        ->join('client_rep_tbl as cr','cr.cl_no','=','cl.cl_no')
        ->join('contract_bill_tbl as cb','cb.cb_id','=','ci.cb_id')
        ->where('invoice_tbl.invoice_id',$_GET['id'])->get();
        $task = DB::table('project_tbl as pr')
        ->join('project_task_tbl as pt','pr.proj_no','=','pt.proj_no')
        ->join('task_tbl','task_tbl.task_id','=','pt.task_id')
        ->join('phase_tbl','phase_tbl.phase_id','=','task_tbl.phase_id')
        ->join('invoice_tbl','pr.proj_no','=','invoice_tbl.proj_no')
        ->where('pt.invoice_id',$_GET['id'])->get();
        $intask = DB::table('project_tbl as pr')
        ->join('project_task_tbl as pt','pr.proj_no','=','pt.proj_no')
        ->join('task_tbl','task_tbl.task_id','=','pt.task_id')
        ->where('pt.invoice_id',$_GET['id'])->get();

        foreach ($intask as $intask) {
          $currentexpense += $intask->pt_total_cost;
        }

        $inper = DB::table('invoice_tbl as in')
        ->where('in.proj_no',$_GET['id'])
        ->where('in.invoice_no','0')->get();

        foreach ($inper as $inper) {
          $invoiceper = $inper->proj_percentage;
        }

        $expense = $currentexpense;
        view()->share('proj',$proj);
        view()->share('task',$task);
        view()->share('expense',$expense);
        view()->share('invoiceper',$invoiceper);
        $pdf = PDF::loadView('pdfinvoice', compact($proj,$task,$expense,$invoiceper));
          // return $pdf->download('invoice.pdf');
        return $pdf->stream("Invoice");
      }

      public function getClientCompany(Request $req){
        $type = DB::table('project_tbl as pr')->where('pr.proj_no',$req->id)
        ->join('project_info_tbl','pr.proj_no','=','project_info_tbl.proj_no')
        ->join('employee_tbl','project_info_tbl.emp_id','=','employee_tbl.emp_id')
        ->join('contract_info_tbl','contract_info_tbl.ci_no','=','pr.ci_no')
        ->join('client_tbl','contract_info_tbl.cl_no','=','client_tbl.cl_no')
        ->join('client_rep_tbl','client_rep_tbl.cl_no','=','client_tbl.cl_no')->get();
        return response()->json($type);
      }

      public function editClientCompany(){
        DB::table('project_tbl as pr')
        ->join('project_info_tbl','pr.proj_no','=','project_info_tbl.proj_no')
        ->join('contract_info_tbl','contract_info_tbl.ci_no','=','pr.ci_no')
        ->join('client_tbl','contract_info_tbl.cl_no','=','client_tbl.cl_no')
        ->join('client_rep_tbl','client_rep_tbl.cl_no','=','client_tbl.cl_no')
        ->where('pr.proj_no',$_POST['id'])->update([
          'cr_first_name' => $_POST['client_fname'],
          'cr_last_name' => $_POST['client_lname'],
          'cr_address' => $_POST['client_address'],
          'cr_email' => $_POST['client_email'],
          'cr_contact' => $_POST['client_phone'],
          'cr_position' => $_POST['client_position'],
          'cl_company' => $_POST['company-name'],
          'cl_address' => $_POST['company-address'],
          'cl_email' => $_POST['company-email'],
          'cl_contact' => $_POST['company-phone'],
        ]);
        return back();
      }


      public function approveequipreq(Request $req){
        $id = session('id');
        $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();

       //notification
        $notif = DB::table('notification_tbl as notif')
        ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
        ->orderBy('notif.notif_date', 'desc')
        ->take(5)->get();

        $notifcount = DB::table('notification_tbl as notif')
        ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
        ->where('notif.notif_admin_status','unview')->count();

        $equipcat = DB::table('equipment_category as ec')
        ->join('equipment_info_tbl as ei','ei.ec_id','=','ec.ec_id')
        ->join('equipment_deployed_tbl as ed','ed.ei_id','=','ei.ei_id')
        ->join('equipment_jobrequest_tbl as ejr','ejr.ed_id','=','ed.ed_id')
        ->join('req_items_tbl as ri','ri.ejr_no','=','ejr.ejr_no')
        ->where('req_item_id',$req->id)->get();

        return view('deploy_equip_req',['empPic'=>$empPic,'equipcat'=>$equipcat,'id'=>$id,'notif'=>$notif,'notifcount'=>$notifcount]);
      }

      public function addequipdep(){
        DB::table('equip_trial')->insert([
          'ejr_no' => $_POST['ejrno'],
          'et_trialrun_by' => $_POST['trial'],
          'et_date' => $_POST['date'],
          'et_result' => $_POST['result'],
          'et_turned_over' => $_POST['turn'],
          'et_accept_by' => $_POST['accept'],
        ]);
        DB::table('req_items_tbl')->where('req_item_id',$_POST['id'])->update([
          'req_status' => 'Approved',
        ]);

        $eiid = $_POST['ei_id'];
        $start_date = $_POST['start_date'];
        $total_days = $_POST['total_days'];
        for ($x = 0; $x < count($eiid) ; $x++) {
          DB::table('equipment_deployed_tbl')->insert([
            'ed_date' => $_POST['date'],
            'ei_id' => $eiid[$x],
            'proj_no' => $_POST['projno'],
            'ed_start_date' => $start_date[$x],
            'ed_total_days' => $total_days[$x],
            ]);//DB
          DB::table('equipment_info_tbl')->where('ei_id',$eiid[$x])->update([
            'ei_status' => 'Deployed',
            ]);//DB
          }//for
          return redirect('/project_edit?id='.$_POST['projno']);
        }
        public function rejectequipreq(){
          DB::table('req_items_tbl')->where('req_item_id',$_GET['id'])->update([
            'req_status' => 'Rejected',
          ]);
          return back();
        }


        public function pdftimeextreq(){
          $terno = "";
          DB::table('timeext_request_tbl as ter')->where('ter.ter_id',$_GET['id'])->update([
            'ter_no' => 'TER'.time(),
            'ter_status' => 'Sent',
          ]);
          $terid =  DB::table('timeext_request_tbl as ter')->where('ter.ter_id',$_GET['id'])->get();
          foreach($terid as $terid) {
           $terno = $terid->ter_no;
         }
         $ter = DB::table('project_tbl as pr')
         ->join('project_info_tbl as pi','pr.proj_no','=','pi.proj_no')
         ->join('timeext_request_tbl as ter','ter.proj_no','=','pr.proj_no')
         ->join('contract_info_tbl as ci','ci.ci_no','=','pr.ci_no')
         ->join('client_tbl as cl','ci.cl_no','=','cl.cl_no')
         ->join('client_rep_tbl as cr','cr.cl_no','=','cl.cl_no')
         ->join('employee_tbl as emp','emp.emp_id','=','pi.emp_id')
         ->where('ter.ter_id',$_GET['id'])->get();
         view()->share('ter',$ter);
         $pdf = PDF::loadView('pdftimeextreq', compact($ter));
      			// return $pdf->strean("Time Extension Request");
         return $pdf->save(public_path().'/files/time extension request/'.$terno.'.pdf')->download($terno.'.pdf');

       }


       public function approvetimeextreq(){
        $cb_total = 0;
        $cb_balance = 0;
        $cb_budget = 0;
        $cb_budget_left = 0;
        $ter_amount = 0;
        $cb_id = 0;
          //approve request
        DB::table('timeext_request_tbl as ter')->where('ter.ter_id',$_GET['id'])->update([
          'ter_status' => 'Approved',
        ]);
          //get request details
        $terdetails = DB::table('timeext_request_tbl as ter')->where('ter.ter_id',$_GET['id'])->get();
        foreach ($terdetails as $terdetails) {
          $proj_no = $terdetails->proj_no;
          $noofdays = $terdetails->ter_days;
          $ter_amount = $terdetails->ter_amount;
        }
          //add days requested to project
        $projdetails = DB::table('project_tbl as pr')->where('pr.proj_no',$proj_no)->get();
        foreach ($projdetails as $projdetails) {
          $proj_end_date = $projdetails->proj_end_date;
          $addd = '+ '.$noofdays.' days';
          $newend = date('Y-m-d',strtotime($proj_end_date. $addd)) ;
        }
        DB::table('project_tbl as pr')->where('pr.proj_no',$proj_no)->update([
          'proj_end_date' => $newend,
        ]);
          //add days requested to phases
        $phasedetails = DB::table('project_phase_tbl as pp')
        ->join('project_tbl as pr','pr.proj_no','=','pp.proj_no')
        ->where('pr.proj_no',$proj_no)->get();
        foreach ($phasedetails as $phasedetails) {
          $pp_id = $phasedetails->pp_id;
          $pp_end_date = $phasedetails->pp_end_date;
          $addd = '+ '.$noofdays.' days';
          $newend = date('Y-m-d',strtotime($pp_end_date. $addd)) ;
          DB::table('project_phase_tbl as pp')->where('pp.pp_id',$pp_id)->update([
            'pp_end_date' => $newend,
          ]);
        }
          //add days requested to tasks
        $taskdetails = DB::table('project_task_tbl as pt')
        ->join('project_tbl as pr','pr.proj_no','=','pt.proj_no')
        ->where('pr.proj_no',$proj_no)->get();
        foreach ($taskdetails as $taskdetails) {
          $pt_id = $taskdetails->pt_id;
          $pt_end_date = $taskdetails->pt_end_date;
          $addd = '+ '.$noofdays.' days';
          $newend = date('Y-m-d',strtotime($pt_end_date. $addd)) ;
          DB::table('project_task_tbl as pt')->where('pt.pt_id',$pt_id)->update([
            'pt_end_date' => $newend,
          ]);
        }
          //add budget requested to project
        $cb = DB::table('contract_bill_tbl as cb')
        ->join('contract_info_tbl as ci','cb.cb_id','=','ci.cb_id')
        ->join('project_tbl as pr','pr.ci_no','=','ci.ci_no')
        ->where('pr.proj_no',$proj_no)->get();
        foreach ($cb as $cb) {
          $cb_total = $cb->cb_total + $ter_amount;
          $cb_balance = $cb->cb_balance + $ter_amount;
          $cb_budget = $cb->cb_budget + $ter_amount;
          $cb_budget_left = $cb->cb_budget_left + $ter_amount;
          $cb_id = $cb->cb_id;
        }
        DB::table('contract_bill_tbl as cb')->where('cb.cb_id',$cb_id)->update([
          'cb_total' => $cb_total,
          'cb_balance' => $cb_balance,
          'cb_budget' => $cb_budget,
          'cb_budget_left' => $cb_budget_left,
        ]);

        return back();
      }

      public function rejecttimeextreq(){
        $cb_total = 0;
        $cb_balance = 0;
        $cb_budget = 0;
        $cb_budget_left = 0;
        $ter_amount = 0;
        $cb_id = 0;
        DB::table('timeext_request_tbl as ter')->where('ter.ter_id',$_GET['id'])->update([
          'ter_status' => 'Rejected',
        ]);
          //get request details
        $terdetails = DB::table('timeext_request_tbl as ter')->where('ter.ter_id',$_GET['id'])->get();
        foreach ($terdetails as $terdetails) {
          $proj_no = $terdetails->proj_no;
          $noofdays = $terdetails->ter_days;
          $ter_amount = $terdetails->ter_amount;
        }
          //add budget requested to project
        $cb = DB::table('contract_bill_tbl as cb')
        ->join('contract_info_tbl as ci','cb.cb_id','=','ci.cb_id')
        ->join('project_tbl as pr','pr.ci_no','=','ci.ci_no')
        ->where('pr.proj_no',$proj_no)->get();
        foreach ($cb as $cb) {
          $cb_total = $cb->cb_total + $ter_amount;
          $cb_balance = $cb->cb_balance + $ter_amount;
          $cb_budget = $cb->cb_budget + $ter_amount;
          $cb_budget_left = $cb->cb_budget_left + $ter_amount;
          $cb_id = $cb->cb_id;
        }
        DB::table('contract_bill_tbl as cb')->where('cb.cb_id',$cb_id)->update([
          'cb_total' => $cb_total,
          'cb_balance' => $cb_balance,
          'cb_budget' => $cb_budget,
          'cb_budget_left' => $cb_budget_left,
        ]);
        return back();
      }

      public function editProjContract(){
        DB::table('project_tbl as pr')->where('pr.proj_no',$_POST['proj_no'])
        ->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')->update([
          'ci_name' => $_POST['ci_name'],
        ]);
        return back();
      }

      public function getinvoice(Request $req){
        $type = DB::table('invoice_tbl')
        ->join('project_tbl as pr','invoice_tbl.proj_no','=','pr.proj_no')
        ->join('project_info_tbl as pi','pi.proj_no','=','pr.proj_no')
        ->where('invoice_tbl.invoice_no',$req->id)->get();

        return response()->json($type);
      }

      public function openproject(){
        $totpercent  = 0;
        $notask = DB::table('project_task_tbl as pt')->where('pt.proj_no',$_GET['id'])->count();
        $task = DB::table('project_task_tbl as pt')->where('pt.proj_no',$_GET['id'])
        ->join('task_tbl','task_tbl.task_id','=','pt.task_id')
        ->join('project_phase_tbl as pp','pp.pp_id','=','pt.pp_id')->get();
        foreach($task as $percent){
         $totpercent += $percent->pt_percentage;
       }
       $projpercent = $totpercent / $notask;
       if($projpercent==100){
         $status = 'Complete';
       }
       elseif ($projpercent==0) {
         $status = 'Pending';
       }
       else {
         $status = 'On Going';
       }
       DB::table('project_tbl')->where('project_tbl.proj_no',$_GET['id'])->update([
        'proj_status' => $status,
      ]);
       return back();
     }

	//***** PROJECT_FINANCIAL *****//
     public function ProjectFinancial(){
      $id = session('id');
      $fin = DB::table('project_tbl as pr')
      ->join('project_info_tbl as pi','pi.proj_no','=','pr.proj_no')
      ->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')
      ->join('contract_bill_tbl','contract_bill_tbl.cb_id','=','contract_info_tbl.cb_id')
      ->where('deleted',0)->get();
      $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
      
       //notification
      $notif = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
      ->orderBy('notif.notif_date', 'desc')
      ->take(5)->get();

      $notifcount = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
      ->where('notif.notif_admin_status','unview')->count();
      
      return view('project_financial',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount, 'fin' => $fin,'empPic'=>$empPic]);
    }

    public function ProjectFinancialView(){
      $id = session('id');
      $task = DB::table('project_tbl as pr')
      ->join('project_info_tbl as pi','pi.proj_no','=','pr.proj_no')
      ->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')
      ->join('contract_bill_tbl','contract_bill_tbl.cb_id','=','contract_info_tbl.cb_id')
      ->join('project_task_tbl as pt','pr.proj_no','=','pt.proj_no')
      ->join('task_tbl','task_tbl.task_id','=','pt.task_id')
      ->where('pr.proj_no',$_GET['id'])->get();

      $fin = DB::table('project_tbl as pr')
      ->join('project_info_tbl as pi','pi.proj_no','=','pr.proj_no')
      ->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')
      ->join('employee_tbl','pi.emp_id','=','employee_tbl.emp_id')
      ->join('contract_bill_tbl','contract_bill_tbl.cb_id','=','contract_info_tbl.cb_id')
      ->where('pr.proj_no',$_GET['id'])->get();
      $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
      
       //notification
      $notif = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
      ->orderBy('notif.notif_date', 'desc')
      ->take(5)->get();

      $notifcount = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
      ->where('notif.notif_admin_status','unview')->count();
      
      return view('project_financial_detail',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount, 'fin' => $fin, 'task' => $task,'empPic'=>$empPic]);
    }
    
    public function FinancialReport(){
      $id = session('id');
      $fin = DB::table('project_tbl as pr')
      ->join('project_info_tbl as pi','pi.proj_no','=','pr.proj_no')
      ->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')
      ->join('contract_bill_tbl','contract_bill_tbl.cb_id','=','contract_info_tbl.cb_id')
      ->where('deleted',0)->get();
      $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
      
       //notification
      $notif = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
      ->orderBy('notif.notif_date', 'desc')
      ->take(5)->get();

      $notifcount = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
      ->where('notif.notif_admin_status','unview')->count();
      
      return view('financial',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount, 'fin' => $fin,'empPic'=>$empPic]);
    }
    
    public function Monthly_Report(){
      $id = session('id');
      $fin = DB::table('project_tbl as pr')
      ->join('project_info_tbl as pi','pi.proj_no','=','pr.proj_no')
      ->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')
      ->join('contract_bill_tbl','contract_bill_tbl.cb_id','=','contract_info_tbl.cb_id')
      ->where('deleted',0)->get();
      $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
      
        //notification
      $notif = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
      ->where('notif.notif_description', 'not like', '%added%')
      ->orderBy('notif.notif_date', 'desc')
      ->take(5)->get();

      $notifcount = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
      ->where('notif.notif_description', 'not like', '%added%')
      ->where('notif.notif_admin_status','unview')->count();

      return view('monthly_report',['fin' => $fin,'empPic'=>$empPic,'id'=>$id,'notif'=>$notif,'notifcount'=>$notifcount]);
    }

    public function DownloadFinancial(){
      $fin = DB::table('project_tbl as pr')
      ->join('project_info_tbl as pi','pi.proj_no','=','pr.proj_no')
      ->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')
      ->join('employee_tbl','pi.emp_id','=','employee_tbl.emp_id')
      ->join('contract_bill_tbl','contract_bill_tbl.cb_id','=','contract_info_tbl.cb_id')
      ->where('pr.proj_no',$_GET['id'])->get();

      $proj = DB::table('project_tbl as pr')
      ->join('project_info_tbl as pi','pi.proj_no','=','pr.proj_no')
      ->join('contract_info_tbl as ci','pr.ci_no','=','ci.ci_no')
      ->join('contract_bill_tbl as cb','cb.cb_id','=','ci.cb_id')
      ->where('pr.proj_no',$_GET['id'])->get();

      $proj_history = DB::table('proj_percentage_history_tbl as pph')
      ->join('project_tbl as proj','proj.proj_no','=','pph.proj_no')
      ->where('pph.proj_no',$_GET['id'])
      ->orderBy('pph.pph_date','asc')->get();


      view()->share('fin',$fin);
      view()->share('proj',$proj);
      view()->share('proj_history',$proj_history);
      $pdf = PDF::loadView('pdffinancial', compact($fin,$proj,$proj_history))->setPaper('legal', 'landscape');
			// return $pdf->download('invoice.pdf');
      return $pdf->stream("Monthly Report");
    }
    
    public function EquipmentUtilization(){
      $id = session('id');
      $var = DB::table('project_tbl as p')
      ->join('project_info_tbl as pi','p.proj_no','=','pi.proj_no')
      ->join('contract_info_tbl as ci','p.ci_no','=','ci.ci_no')
      ->where('deleted',0)->get();
      $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
       //notification
      $notif = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
      ->where('notif.notif_description', 'not like', '%added%')
      ->orderBy('notif.notif_date', 'desc')
      ->take(5)->get();

      $notifcount = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
      ->where('notif.notif_description', 'not like', '%added%')
      ->where('notif.notif_admin_status','unview')->count();

      return view('equipment_utilization',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount,'var' => $var,'empPic'=>$empPic]);
    }
    
    public function DownloadEquipment(){
      $empid = session('id');
      $id = $_GET['id'];
      $equip = DB::select("Select ec_category,ed_date,ed_start_date,ed_total_days,DATEDIFF(ed_start_date,ed_date) as days
        FROM equipment_deployed_tbl as ed 
        JOIN equipment_info_tbl as ei ON ei.ei_id = ed.ei_id 
        JOIN equipment_category as ec ON ec.ec_id = ei.ec_id 
        WHERE ed.ei_id = ei.ei_id AND ei.ec_id = ec.ec_id AND ed.proj_no = :id",array('id' => $id,));

      $fin = DB::table('project_tbl as pr')
      ->join('project_info_tbl as pi','pi.proj_no','=','pr.proj_no')
      ->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')
      ->join('employee_tbl','pi.emp_id','=','employee_tbl.emp_id')
      ->join('contract_bill_tbl','contract_bill_tbl.cb_id','=','contract_info_tbl.cb_id')
      ->where('pr.proj_no',$id)->get();

      $proj = DB::table('project_tbl as pr')
      ->join('project_info_tbl as pi','pi.proj_no','=','pr.proj_no')
      ->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')
      ->where('pr.proj_no',$id)->get();


      view()->share('equip',$equip);
      view()->share('fin',$fin);
      view()->share('proj',$proj);
      $pdf = PDF::loadView('pdfequipment', compact($equip,$fin,$proj))->setPaper('legal', 'landscape');
			// return $pdf->download('invoice.pdf');
      return $pdf->stream("Monthly Report");
      $empPic = DB::table('employee_tbl')->where('emp_id',$empid)->get();
      return view('pdfequipment',['equip' => $equip,'empPic'=>$empPic]);
    }
    /*QUERIES*/

//Employee
    public function queryEmployee(){
      $id = session('id');
      $var = DB::table('employee_tbl')->join('users','employee_tbl.emp_id','=','users.emp_id')->where('employee_tbl.emp_status',0)->get();
      $type = DB::table('users')->where('el_status',0)->get();
      $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
      
      $notif = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
      ->where('notif.notif_description', 'not like', '%added a project to you%')
      ->orderBy('notif.notif_date', 'desc')
      ->take(5)->get();
      
      $notifcount = DB::table('notification_tbl as notif')
      ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
      ->where('notif.notif_admin_status','unview')->count();
      
      return view('queryEmployee',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount, 'var' => $var,'type' => $type,'empPic'=>$empPic]);
    } 
    
    public function searchemp(Request $req){
     if ($req->status == 'Deployed') {
      $qry = 'SELECT DISTINCT emp.emp_id, emp.emp_first_name,emp.emp_middle_initial,emp.emp_last_name, emp.emp_image, emp.emp_address,
      emp.emp_email, emp.emp_contact, users.el_position, users.username, pi.pi_title, proj.proj_no
      FROM `employee_tbl` as emp
      JOIN  `users` ON users.emp_id = emp.emp_id
      JOIN  `project_info_tbl` as pi ON pi.emp_id = emp.emp_id
      JOIN  `project_tbl` as proj ON proj.proj_no = pi.proj_no
      WHERE emp.emp_first_name LIKE "%'.$req->fname.'%" AND emp.emp_last_name LIKE "%'.$req->lname.'%"
      AND emp.emp_middle_initial LIKE "%'.$req->mname.'%" AND emp.emp_address LIKE "%'.$req->address.'%"
      AND users.el_position LIKE "%'.$req->position.'%" AND proj.proj_status IN ("On Going", "Pending")
      ';
    }
    else if ($req->status == 'Available') {
      $qry = 'SELECT DISTINCT emp.emp_id, emp.emp_first_name,emp.emp_middle_initial,emp.emp_last_name, emp.emp_image, emp.emp_address,
      emp.emp_email, emp.emp_contact, users.el_position, users.username
      FROM `employee_tbl` as emp
      JOIN  `users` ON users.emp_id = emp.emp_id
      LEFT JOIN  `project_info_tbl` as pi ON pi.emp_id = emp.emp_id
      LEFT JOIN  `project_tbl` as proj ON proj.proj_no = pi.proj_no
      WHERE emp.emp_first_name LIKE "%'.$req->fname.'%" AND emp.emp_last_name LIKE "%'.$req->lname.'%"
      AND emp.emp_middle_initial LIKE "%'.$req->mname.'%" AND emp.emp_address LIKE "%'.$req->address.'%"
      AND users.el_position LIKE "%'.$req->position.'%" AND pi.emp_id IS NULL
      ';
    }
    else {
      $qry = 'SELECT DISTINCT emp.emp_id, emp.emp_first_name,emp.emp_middle_initial,emp.emp_last_name, emp.emp_image, emp.emp_address,
      emp.emp_email, emp.emp_contact, users.el_position, users.username
      FROM `employee_tbl` as emp
      JOIN  `users` ON users.emp_id = emp.emp_id
      WHERE emp.emp_first_name LIKE "%'.$req->fname.'%" AND emp.emp_last_name LIKE "%'.$req->lname.'%"
      AND emp.emp_middle_initial LIKE "%'.$req->mname.'%" AND emp.emp_address LIKE "%'.$req->address.'%"
      AND users.el_position LIKE "%'.$req->position.'%" 
      ';
    }
    
    $type = DB::select($qry);
    
    return response()->json($type);
  }
  
  //Client-Company
  public function queryclient(){
    $id = session('id');
    $var = DB::table('client_tbl')
    ->join('client_rep_tbl as cr','cr.cl_no','=','client_tbl.cl_no')
    ->where('client_tbl.cl_delete',0)->get();
    $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
    
    $notif = DB::table('notification_tbl as notif')
    ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
    ->where('notif.notif_description', 'not like', '%added a project to you%')
    ->orderBy('notif.notif_date', 'desc')
    ->take(5)->get();
    
    $notifcount = DB::table('notification_tbl as notif')
    ->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
    ->where('notif.notif_admin_status','unview')->count();
    
    return view('queryClient',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount, 'var' => $var,'empPic'=>$empPic]);
  }
  
  public function searchclient(Request $req){
    if ($req->status == 'Active') {
      $qry = 'SELECT DISTINCT cl.cl_company, cl.cl_no, cl.cl_contact, cl.cl_email,  cr.cr_id, cl.cl_address, cr.cr_first_name, cr.cr_last_name, cr.cr_position
      FROM `client_tbl` as cl
      JOIN  `client_rep_tbl` as cr ON cl.cl_no = cr.cl_no
      JOIN  `contract_info_tbl` as ci ON ci.cl_no = cl.cl_no
      JOIN  `project_tbl` as proj ON proj.ci_no = ci.ci_no
      JOIN  `project_info_tbl` as pi ON pi.proj_no = pi.proj_no
      WHERE cl.cl_company LIKE "%'.$req->name.'%" AND cl.cl_address LIKE "%'.$req->address.'%"
      AND cr.cr_first_name LIKE "%'.$req->fname.'%" AND cr.cr_last_name LIKE "%'.$req->lname.'%"
      AND cl.cl_delete = 0 AND proj.proj_status IN ("On Going", "Pending")
      ';
    }
    else if ($req->status == 'Inactive') {
      $qry = 'SELECT DISTINCT cl.cl_company, cl.cl_no, cl.cl_contact, cl.cl_email,  cr.cr_id, cl.cl_address, cr.cr_first_name, cr.cr_last_name, cr.cr_position
      FROM `client_tbl` as cl
      JOIN  `client_rep_tbl` as cr ON cl.cl_no = cr.cl_no
      JOIN  `contract_info_tbl` as ci ON ci.cl_no = cl.cl_no
      JOIN  `project_tbl` as proj ON proj.ci_no = ci.ci_no
      JOIN  `project_info_tbl` as pi ON pi.proj_no = pi.proj_no
      WHERE cl.cl_company LIKE "%'.$req->name.'%" AND cl.cl_address LIKE "%'.$req->address.'%"
      AND cr.cr_first_name LIKE "%'.$req->fname.'%" AND cr.cr_last_name LIKE "%'.$req->lname.'%"
      AND cl.cl_delete = 0 AND proj.proj_status NOT IN ("On Going", "Pending")
      ';
    }
    else {
      $qry = 'SELECT DISTINCT cl.cl_company, cl.cl_no, cl.cl_contact, cl.cl_email,  cr.cr_id, cl.cl_address, cr.cr_first_name, cr.cr_last_name, cr.cr_position
      FROM `client_tbl` as cl
      JOIN  `client_rep_tbl` as cr ON cl.cl_no = cr.cl_no
      WHERE cl.cl_company LIKE "%'.$req->name.'%" AND cl.cl_address LIKE "%'.$req->address.'%"
      AND cr.cr_first_name LIKE "%'.$req->fname.'%" AND cr.cr_last_name LIKE "%'.$req->lname.'%"
      AND cl.cl_delete = 0
      ';
    }
    $type = DB::select($qry);
    
    return response()->json($type);
  }




}
