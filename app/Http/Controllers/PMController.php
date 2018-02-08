<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use PDF;
class PMController extends Controller
{


  public function __construct()
  {
      $this->middleware('CheckLogin');
      $this->middleware('PM');
  }

 	public function Dashboard(){
        return view('dashboard');
    }
    
      public function indexPM(){
        //return session('message');
        $id = session('id');
		$notifco = 0;
		$projdead = 0;
		$projdelay = 0;
		$tasknodate = 0;
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
            ->join('contract_info_tbl','contract_info_tbl.ci_no','=','pr.ci_no')
            ->join('contract_bill_tbl','contract_info_tbl.cb_id','=','contract_bill_tbl.cb_id')
            ->join('client_tbl','contract_info_tbl.cl_no','=','client_tbl.cl_no')
            ->where('deleted',0)
            ->where('emp_id',$id)->get();
        $invoice = DB::table('project_tbl as pr')
			->join('project_info_tbl as pi','pi.proj_no','=','pr.proj_no')
			->join('invoice_tbl','invoice_tbl.proj_no','=','pr.proj_no')
		    ->join('contract_info_tbl','contract_info_tbl.ci_no','=','pr.ci_no')
            ->where('deleted',0)
            ->where('emp_id',$id)->get();
        $proj = DB::table('project_tbl as pr')
			->join('project_info_tbl as pi','pr.proj_no','=','pi.proj_no')
			->join('employee_tbl','pi.emp_id','=','employee_tbl.emp_id')
			->where('deleted',0)
            ->where('pi.emp_id',$id)->get();
			
		foreach($proj as $proj) {
			$task = DB::table('project_tbl as pr')
			->join('project_task_tbl as pt','pt.proj_no','=','pr.proj_no')
			->where('deleted',0)
            ->where('pt.proj_no',$proj->proj_no)->get();
			
			if(date("Y-m-d",strtotime($proj->proj_end_date)) <= date("Y-m-d",strtotime("+4 weeks")) && date("Y-m-d",strtotime($proj->proj_end_date)) > date("Y-m-d",strtotime("now"))) {	
				if($proj->proj_percentage < 100) {
					$text = $proj->pi_title.' must be completed in a month. Project termination point is on '.$proj->proj_end_date;
					$notifco = DB::table('notification_tbl')
						->whereDate('notif_date', date("Y-m-d"))
						->where('notif_description',$text)->count();
					if($notifco == 0) {
						DB::table('notification_tbl')->insert([
						'notif_description' => $text,
						'proj_no' => $proj->proj_no,
						'notif_from' => $id,
						'notif_to' => $id,
						'notif_date' => date_create('now'),
						'notif_url' => '/project_edit?id='.$proj->proj_no,
						'notif_pm_url' => '/PM_project_edit?id='.$proj->proj_no,
						'notif_icon' => 'proj.png',
						]);
					}
				}
			} else if(date("Y-m-d",strtotime($proj->proj_end_date)) <= date("Y-m-d",strtotime("now"))){
				if($proj->proj_percentage < 100) {
					$text = $proj->pi_title.' was now delay on its schedule. Project construction was ended on '.$proj->proj_end_date;
					$notifco = DB::table('notification_tbl')
						->whereDate('notif_date', date("Y-m-d"))
						->where('notif_description',$text)->count();
					if($notifco == 0) {
						DB::table('notification_tbl')->insert([
						'notif_description' => $text,
						'proj_no' => $proj->proj_no,
						'notif_from' => $id,
						'notif_to' => $id,
						'notif_date' => date_create('now'),
						'notif_url' => '/project_edit?id='.$proj->proj_no,
						'notif_pm_url' => '/PM_project_edit?id='.$proj->proj_no,
						'notif_icon' => 'proj-delay.png',
						]);
					}
				}
			} else {
					
			}
			
			foreach($task as $task) {
				if($task->pt_end_date != '1111-11-11'){
                  if(date("Y-m-d",strtotime($task->pt_end_date)) <= date("Y-m-d",strtotime("+2 weeks")) && date("Y-m-d",strtotime($task->pt_end_date)) > date("Y-m-d",strtotime("now"))) {	
                      if($task->pt_percentage < 100) {
                          $projdead++;
                      }
                  }else if(date("Y-m-d",strtotime($task->pt_end_date)) <= date("Y-m-d",strtotime("now"))){
                      if($task->pt_percentage < 100) {
                          $projdelay++;
                      }
                  }//if delayed or not
                }else {
                  $tasknodate++;
                }//if it is already set
			}//foreach
          
            if($projdead != 0) { 
				$text = $projdead.'+'.' tasks of project '.$proj->pi_title.' must be completed in less than 2 weeks.';
				$notifco = DB::table('notification_tbl')
					->whereDate('notif_date', date("Y-m-d"))
					->where('notif_description',$text)->count();
				if($notifco == 0) {
					DB::table('notification_tbl')->insert([
						'notif_description' => $projdead.'+'.' tasks of project '.$proj->pi_title.' must be completed in less than 2 weeks.' ,
						'proj_no' => $proj->proj_no,
						'notif_from' => $id,
						'notif_to' => $id,
						'notif_date' => date_create('now'),
						'notif_url' => '/project_edit?id='.$proj->proj_no,
						'notif_pm_url' => '/PM_project_edit?id='.$proj->proj_no,
						'notif_icon' => 'calendar-icon.png',
					]);
				}//if
			}else if($projdelay != 0) { 
				$text = $projdelay.'+'.' tasks of project '.$proj->pi_title.' were delayed on their deadline.';
				$notifco = DB::table('notification_tbl')
					->whereDate('notif_date', date("Y-m-d"))
					->where('notif_description',$text)->count();
				if($notifco == 0) {
					DB::table('notification_tbl')->insert([
						'notif_description' => $projdelay.'+'.' tasks of project '.$proj->pi_title.' were delayed on their deadline.' ,
						'proj_no' => $proj->proj_no,
						'notif_from' => $id,
						'notif_to' => $id,
						'notif_date' => date_create('now'),
						'notif_url' => '/project_edit?id='.$proj->proj_no,
						'notif_pm_url' => '/PM_project_edit?id='.$proj->proj_no,
						'notif_icon' => 'delay.ico',
					]);
				}//if
			}else if($tasknodate != 0) { 
                $text = "You need to update project phase and project task's start date and end date. (".$proj->pi_title.")";
				$notifco = DB::table('notification_tbl')
					->whereDate('notif_date', date("Y-m-d"))
					->where('notif_description',$text)->count();
				if($notifco == 0) {
					DB::table('notification_tbl')->insert([
						'notif_description' => $text,
						'proj_no' => $proj->proj_no,
						'notif_from' => $id,
						'notif_to' => $id,
						'notif_date' => date_create('now'),
						'notif_url' => '/project_edit?id='.$proj->proj_no,
						'notif_pm_url' => '/PM_project_edit?id='.$proj->proj_no,
						'notif_icon' => 'delay.ico',
					]);
                }//if
			}//if else if
		}//
		
		//notification
		$notif = DB::table('notification_tbl as notif')
			->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
			->where('notif.notif_to',$id)
			->orderBy('notif.notif_date', 'desc')
			->take(5)->get();
		
		$notifcount = DB::table('notification_tbl as notif')
			->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
			->where('notif.notif_to',$id)
			->where('notif.notif_pm_status','unview')->count();

        return view('indexProjectManager',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount,'empPic'=>$empPic,'project'=>$project,'invoice'=>$invoice,'equip'=>$equip]);
      }
      public function PMLogout(){
        session()->forget('id');
        //echo session('id')."BYE";
        return redirect('/');
      }
    
      //update notif status to 'view'
      public function updatenotif(Request $req){
          DB::table('notification_tbl')->where('notif_to',$req->id)->update([
          'notif_pm_status' => 'view'
          ]);
          return response()->json();
      }
  
      //**** NOTIFICATION *****/////
    public function pmnotification(){
      $id = session('id');
      
      $empPic = DB::table('employee_tbl')
          ->join('users','employee_tbl.emp_id','=','users.emp_id')
          ->where('employee_tbl.emp_id',$id)
          ->where('employee_tbl.emp_status',0)->get();
      
      $not = DB::table('notification_tbl as notif')
			->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
            ->where('notif.notif_description', 'not like', 'payment%')
            ->where('notif.notif_to', $id)
			->orderBy('notif.notif_date', 'desc')->get();
    
    //notification
		$notif = DB::table('notification_tbl as notif')
			->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
            ->where('notif.notif_description', 'not like', '%payment%')
            ->where('notif.notif_to', $id)
			->orderBy('notif.notif_date', 'desc')
			->take(5)->get();
		
		$notifcount = DB::table('notification_tbl as notif')
			->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
            ->where('notif.notif_description', 'payment', '%payment%')           
            ->where('notif.notif_to', $id)
			->where('notif.notif_pm_status','unview')->count();

    return view('PM_notification',['id' => $id, 'not' => $not, 'notif' => $notif, 'notifcount' => $notifcount, 'empPic'=>$empPic]);
  }
  
      public function PMProfile(){
        $id = session('id');
        $empPic = DB::table('employee_tbl')
            ->join('users','employee_tbl.emp_id','=','users.emp_id')
            ->where('employee_tbl.emp_id',$id)
            ->where('employee_tbl.emp_status',0)->get();
        //notification
		$notif = DB::table('notification_tbl as notif')
			->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
            ->where('notif.notif_description', 'not like', '%payment%')
            ->where('notif.notif_to', $id)
			->orderBy('notif.notif_date', 'desc')
			->take(5)->get();
		
		$notifcount = DB::table('notification_tbl as notif')
			->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
            ->where('notif.notif_description', 'payment', '%payment%')           
            ->where('notif.notif_to', $id)
			->where('notif.notif_pm_status','unview')->count();
    
        return view('PM_profile',['empPic'=>$empPic, 'id'=>$id, 'notif' => $notif, 'notifcount' => $notifcount]);
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

	//***** PM_PROJECT *****//
	public function Project(){
    $id = session('id');
        $var = DB::table('project_tbl as pr')->join('project_info_tbl','pr.proj_no','=','project_info_tbl.proj_no')
		->join('employee_tbl','project_info_tbl.emp_id','=','employee_tbl.emp_id')
		->join('contract_info_tbl','contract_info_tbl.ci_no','=','pr.ci_no')
		->join('client_tbl','contract_info_tbl.cl_no','=','client_tbl.cl_no')
		->where('project_info_tbl.emp_id',$id)
		->where('pr.deleted',0)->get();
        
      $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
      //notification
      $notif = DB::table('notification_tbl as notif')
		->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
		->where('notif.notif_to',$id)
		->orderBy('notif.notif_date', 'desc')
		->take(5)->get();
		
      $notifcount = DB::table('notification_tbl as notif')
		->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
		->where('notif.notif_to',$id)
		->where('notif.notif_pm_status','unview')->count();
      return view('PM_project',['id'=>$id,'var' => $var ,'empPic' => $empPic, 'notif' => $notif, 'notifcount' => $notifcount ]);
    }



	//***** PROJECT_DETAIL *****//
	public function ProjectView(){
    $id = session('id');
        $project = DB::table('project_tbl as pr')->where('pr.proj_no',$_GET['id'])
		->join('project_info_tbl','pr.proj_no','=','project_info_tbl.proj_no')
		->join('employee_tbl','project_info_tbl.emp_id','=','employee_tbl.emp_id')
		->join('contract_info_tbl','contract_info_tbl.ci_no','=','pr.ci_no')
		->join('contract_bill_tbl','contract_info_tbl.cb_id','=','contract_bill_tbl.cb_id')
		->join('client_tbl','contract_info_tbl.cl_no','=','client_tbl.cl_no')
        ->where('deleted',0);

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
            ->where('deleted',0)
			->where('pr.proj_no',$_GET['id'])->get();
		$equipdep = DB::table('equipment_deployed_tbl as ed')->where('ed.proj_no',$_GET['id'])
			->join('equipment_info_tbl as ei','ei.ei_id','=','ed.ei_id')->get();
		$plan = DB::table('project_tbl as pr')
			->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')
			->join('contract_bill_tbl','contract_bill_tbl.cb_id','=','contract_info_tbl.cb_id')
			->join('project_task_tbl as pt','pr.proj_no','=','pt.proj_no')
			->join('task_tbl','task_tbl.task_id','=','pt.task_id')
            ->where('deleted',0)
			->where('pr.proj_no',$_GET['id'])->get();
		$task = DB::table('project_tbl as pr')
			->join('project_task_tbl as pt','pr.proj_no','=','pt.proj_no')
			->join('task_tbl','task_tbl.task_id','=','pt.task_id')
			->join('phase_tbl','phase_tbl.phase_id','=','task_tbl.phase_id')
            ->where('deleted',0)
			->where('pr.proj_no',$_GET['id'])->get();

        $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
		//notification
		$notif = DB::table('notification_tbl as notif')
			->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
			->where('notif.notif_to',$id)
			->orderBy('notif.notif_date', 'desc')
			->take(5)->get();
		
		$notifcount = DB::table('notification_tbl as notif')
			->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
			->where('notif.notif_to',$id)
			->where('notif.notif_pm_status','unview')->count();
    	return view('PM_project_detail',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount,'empPic' => $empPic, 'proj' => $proj, 'client' => $client, 'equipdep' => $equipdep, 'plan' => $plan, 'task' => $task ]);
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


      	public function pdfinvoice(){
      	$proj = DB::table('project_tbl as pr')
      			->join('project_info_tbl','pr.proj_no','=','project_info_tbl.proj_no')
      			->join('invoice_tbl','pr.proj_no','=','invoice_tbl.proj_no')
      			->join('employee_tbl','project_info_tbl.emp_id','=','employee_tbl.emp_id')
      			->join('contract_info_tbl as ci','pr.ci_no','=','ci.ci_no')
      			->join('client_tbl as cl','cl.cl_no','=','ci.cl_no')
      			->join('client_rep_tbl as cr','cr.cl_no','=','cl.cl_no')
      			->join('contract_bill_tbl as cb','cb.cb_id','=','ci.cb_id')
      			->where('pr.proj_no',$_GET['id'])->get();
      	$task = DB::table('project_tbl as pr')
      			->join('project_task_tbl as pt','pr.proj_no','=','pt.proj_no')
      			->join('task_tbl','task_tbl.task_id','=','pt.task_id')
      			->join('phase_tbl','phase_tbl.phase_id','=','task_tbl.phase_id')
      			->where('pr.proj_no',$_GET['id'])->get();
      			view()->share('proj',$proj);
      	        view()->share('task',$task);
      			$pdf = PDF::loadView('pdfinvoice', compact($proj,$task));
      			// return $pdf->download('invoice.pdf');
      			return $pdf->stream("Invoice");
      	}
	//***** PM_PROJECT_EDIT *****//
	public function ProjectEdit(){
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
            ->join('users','users.emp_id','=','employee_tbl.emp_id')
			->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')
			->join('contract_bill_tbl','contract_bill_tbl.cb_id','=','contract_info_tbl.cb_id')
			->where('pr.proj_no',$_GET['id'])->get();
		$contract = DB::table('project_tbl as pr')
			->join('contract_info_tbl','pr.ci_no','=','contract_info_tbl.ci_no')
			->where('pr.proj_no',$_GET['id'])->get();
		$equipdep = DB::table('equipment_deployed_tbl as ed')->where('ed.proj_no',$_GET['id'])
			->join('equipment_info_tbl as ei','ei.ei_id','=','ed.ei_id')
            ->join('equipment_category as ec','ec.ec_id','=','ei.ec_id')->get();
		$equipreq = DB::table('equipment_deployed_tbl as ed')->where('ed.proj_no',$_GET['id'])
            ->join('equipment_jobrequest_tbl as ejr','ejr.ed_id','=','ed.ed_id')
            ->join('req_items_tbl as ri','ri.ejr_no','=','ejr.ejr_no')->get();
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
			->orderBy('pp.phase_id')
			->orderBy('task_tbl.task_item_no')->get();
		$phase = DB::table('project_phase_tbl as pp')
			->join('phase_tbl','pp.phase_id','=','phase_tbl.phase_id')
			->where('pp.proj_no',$_GET['id'])->distinct()->get();
		$PM = DB::table('employee_tbl as emp')
          ->join('users','users.emp_id','=','emp.emp_id')
          ->where('emp_status',0)
          ->where('el_position','Project Manager')->get();
		$empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
      
        //notification
		$notif = DB::table('notification_tbl as notif')
			->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
			->where('notif.notif_to',$id)
			->orderBy('notif.notif_date', 'desc')
			->take(5)->get();
		
		$notifcount = DB::table('notification_tbl as notif')
			->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
			->where('notif.notif_to',$id)
			->where('notif.notif_pm_status','unview')->count();


    	return view('PM_project_edit',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount,'proj' => $proj, 'empPic' => $empPic, 'client' => $client, 'equipdep' => $equipdep, 'equipreq' => $equipreq, 'plan' => $plan, 'task' => $task, 'PM' => $PM, 'phase' => $phase, 'contract' => $contract, 'ter' => $ter]);
    }

	public function editPMproject(){
        DB::table('project_tbl')->join('project_info_tbl as pi','project_tbl.proj_no','=','pi.proj_no')->where('project_tbl.proj_no',$_POST['project-id'])->update([
            'pi_title' => $_POST['project-name'],
            'pi_construction_site' => $_POST['project-site'],
            'pi_description' => $_POST['project-desc'],
            'pi_construction_site' => $_POST['project-site'],
            'pi_description' => $_POST['project-desc'],
            'pi_floor_no' => $_POST['floor-no'],
            'pi_floor_area' => $_POST['floor-area'],
            'pi_road_length' => $_POST['road-length'],
            'pi_road_type' => $_POST['road-type'],
            ]);
			$id = $_POST['project-id'];
        return redirect('/PM_project_edit?id='.$id);
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
        DB::table('project_tbl as pr')->where('pr.proj_no',$_POST['id'])
		->join('project_info_tbl','pr.proj_no','=','project_info_tbl.proj_no')
		->join('employee_tbl','project_info_tbl.emp_id','=','employee_tbl.emp_id')
		->join('contract_info_tbl','contract_info_tbl.ci_no','=','pr.ci_no')
		->join('client_tbl','contract_info_tbl.cl_no','=','client_tbl.cl_no')
		->join('client_rep_tbl','client_rep_tbl.cl_no','=','client_tbl.cl_no')->update([
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

	public function getProjectTask(Request $req){
        $type = DB::table('project_task_tbl as pt')->where('pt.pt_id',$req->id)
			->join('task_tbl','task_tbl.task_id','=','pt.task_id')
			->join('project_phase_tbl as pp','pp.pp_id','=','pt.pp_id')->get();
		return response()->json($type);
    }

	public function editProjectTask(){
		$totpercent = 0;
		$phasepercent = 0;
        $recentprojpercentage = 0;
        $phaseid = 0;
		$projpercent = 0;
        $recentprojexpense = 0;
		$projexpense = 0;
		$projbudgetleft = 0;
		$pt_proj_percentage = 0;
		$proj_no = $_POST['proj_no'];
		//update task
        DB::table('project_task_tbl as pt')->where('pt.pt_id',$_POST['id'])
			->join('task_tbl','task_tbl.task_id','=','pt.task_id')->update([
            'pt_status' => $_POST['select_taskstatus'],
            'pt_percentage' => $_POST['select_taskpercent'],
            'pt_start_date' => $_POST['start_task'],
            'pt_end_date' => $_POST['end_task'],
			      'pt_date_completed' => date_create('now'),
            'pt_expense' => $_POST['task_expense'],
            //'pt_reason_delay' => $_POST['reason-delay'],
            ]);
		//update phase percentage using tasks in each phase
		for ($x = 1; $x < 10 ; $x++) {
		$phase = DB::table('project_phase_tbl as pp')
			->where('pp.phase_id',$x)
			->where('pp.proj_no',$proj_no);
		$phs = $phase->get();
		foreach($phs as $phs){
		$phaseid = $phs->pp_id;
		}

		$notask = DB::table('project_task_tbl as pt')->where('pt.proj_no',$proj_no)->where('pt.pp_id','=',$phaseid)->count();
        $task = DB::table('project_task_tbl as pt')
			->join('task_tbl','task_tbl.task_id','=','pt.task_id')
			->join('project_phase_tbl as pp','pp.pp_id','=','pt.pp_id')
			->where('pt.proj_no',$proj_no)
			->where('pt.pp_id',$phaseid)->get();
		foreach($task as $percent){
			$phasepercent += $percent->pt_percentage / $notask;
		}
		if($phasepercent==100){
			$status = 'Complete';
		}
		elseif ($phasepercent==0){
			$status = 'Pending';
		}
		else {
			$status = 'On Going';
		}
		DB::table('project_phase_tbl as pp')->join('project_tbl as pr','pp.proj_no','=','pr.proj_no')
		->where('pr.proj_no',$proj_no)->where('pp.pp_id',$phaseid)->update([
		'pp_percentage' => $phasepercent,
		'pp_status' => $status,
		]);
		$phasepercent=0;
	}
		//computes project percetage using percentage of tasks
		$task = DB::table('project_task_tbl as pt')->where('pt.proj_no',$proj_no)
				->join('task_tbl as t','t.task_id','=','pt.task_id')->get();
		foreach($task as $task){
			$pt_proj_percentage = $task->pt_proj_percentage/100;
			$totpercent += $task->pt_percentage * $pt_proj_percentage;
		}
		$projpercent = $totpercent;
		if($projpercent==100){
			$status = 'Complete';
		}
		elseif ($projpercent==0) {
			$status = 'Pending';
		}
		else {
			$status = 'On Going';
		}
		$proj = DB::table('project_tbl')->where('project_tbl.proj_no',$proj_no)
			->join('project_info_tbl as pi','pi.proj_no','=','project_tbl.proj_no')->get();  // get recent project's percentage
		foreach($proj as $proj){
			$recentprojpercentage = $projpercent-$proj->proj_percentage;
			$projtitle = $proj->pi_title;
		}
        DB::table('project_tbl')->where('project_tbl.proj_no',$proj_no)->update([
		'proj_percentage' => $projpercent,
		'proj_status' => $status,
		]);
		if(($projpercent-$recentprojpercentage) != $projpercent) {
			DB::table('proj_percentage_history_tbl')->insert([
				'proj_no' => $proj_no,
				'pph_percentage_added' => $recentprojpercentage,
				'pph_percentage' => $projpercent,
				'pph_date' => date_create('now'),
			]);
		}
        //compute project expense using tasks' expenses
		$task1 = DB::table('project_task_tbl as pt')->where('pt.proj_no',$proj_no)
				->join('task_tbl as t','t.task_id','=','pt.task_id')->get();
		foreach($task1 as $task1){
			$projexpense += $task1->pt_expense;
		}
		$projbudget = DB::table('contract_bill_tbl as cb')->select('cb.cb_budget')
		->join('contract_info_tbl as ci','ci.cb_id','=','cb.cb_id')
		->join('project_tbl as pr','ci.ci_no','=','pr.ci_no')
		->where('pr.proj_no',$proj_no)->get();
		foreach($projbudget as $projbudget){
		$projbudgetleft = $projbudget->cb_budget - $projexpense;
		}
		DB::table('contract_bill_tbl as cb')->join('contract_info_tbl as ci','ci.cb_id','=','cb.cb_id')
		->join('project_tbl as pr','ci.ci_no','=','pr.ci_no')
		->where('pr.proj_no',$proj_no)->update([
		'cb_expense' => $projexpense,
		'cb_budget_left' => $projbudgetleft,
		]);
        return back();
    }
  
  
    public function getEquipment(Request $req){
      $equipment = DB::table('equipment_deployed_tbl as ed')
            ->where('ed_id',$req->id)
			->join('equipment_info_tbl as ei','ei.ei_id','=','ed.ei_id')
            ->join('equipment_category as ec','ec.ec_id','=','ei.ec_id')->get();
      return response()->json($equipment);
    }
    public function editEquipment(){
      DB::table('equipment_deployed_tbl as ed')
        ->where('ei.ei_id',$_POST['id'])
		->join('equipment_info_tbl as ei','ei.ei_id','=','ed.ei_id')
        ->join('equipment_category as ec','ec.ec_id','=','ei.ec_id')
        ->update([
          'ei_status' => $_POST['status'],
        ]);
      return back();
    }
    public function getEquipmentMaintenance(Request $req){
      $ed_id = DB::table('equipment_jobrequest_tbl')->where('ed_id',$req->id)->first();
      if($ed_id){
        $equipment = DB::table('equipment_deployed_tbl as ed')
              ->join('equipment_jobrequest_tbl as ejr','ejr.ed_id','=','ed.ed_id')
              ->where('ed.ed_id',$req->id)->get();
      }else{
        $equipment = DB::table('equipment_deployed_tbl as ed')
              ->where('ed.ed_id',$req->id)->get();
      }
      return response()->json($equipment);
    }
    public function editEquipmentMaintenance(){
      $emp = session('id');
      $datestarted = $_POST['datestarted'];
      $datecompleted = $_POST['datecompleted'];
      $checkeddate = $_POST['checkeddate'];
      $ed_id = DB::table('equipment_jobrequest_tbl')->where('ed_id',$_POST['id'])->first();
      //echo 'result is: ';
      if($datestarted == ''){
        $datestarted = '1111-11-11';
      }//if it isnull
      if($datecompleted == ''){
        $datecompleted = '1111-11-11';
      }//if it isnull
      if($checkeddate == ''){
        $checkeddate = '1111-11-11';
      }//if it isnull
      if($ed_id){ 
        DB::table('equipment_jobrequest_tbl')
          ->where('ed_id',$_POST['id'])->update([
            'ed_id'=>$_POST['id'],
            'emp_id'=>$emp,
            'ejr_date'=>$_POST['today'],
            'ejr_driver_name'=>$_POST['driver'],
            'ejr_repaired_by'=>$_POST['repairedby'],
            'ejr_date_start'=>$datestarted,
            'ejr_date_completed'=>$datecompleted,
            'ejr_checkedby'=>$_POST['checkedby'],
            'ejr_checked_date'=>$checkeddate,
            'ejr_location'=>$_POST['location'],
            'ejr_problems'=>$_POST['problems'],
            'ejr_work_done'=>$_POST['details'],
        ]);//*/
        //echo 'not empty';
      }else{
        DB::table('equipment_jobrequest_tbl')
          ->where('ed_id',$_POST['id'])->insert([
            'ed_id'=>$_POST['id'],
            'emp_id'=>$emp,
            'ejr_date'=>$_POST['today'],
            'ejr_driver_name'=>$_POST['driver'],
            'ejr_repaired_by'=>$_POST['repairedby'],
            'ejr_date_start'=>$datestarted,
            'ejr_date_completed'=>$datecompleted,
            'ejr_checkedby'=>$_POST['checkedby'],
            'ejr_checked_date'=>$checkeddate,
            'ejr_location'=>$_POST['location'],
            'ejr_problems'=>$_POST['problems'],
            'ejr_work_done'=>$_POST['details'],
        ]);//*/
        //echo 'null';
      }//if there is a record else null
      return back();
    }
    public function getEquipmentRequest(Request $req){
      $equipment = DB::table('equipment_deployed_tbl as ed')
            ->join('equipment_info_tbl as ei','ei.ei_id','=','ed.ei_id')
            ->join('equipment_category as ec','ec.ec_id','=','ei.ec_id')
            ->join('equipment_jobrequest_tbl as ejr','ed.ed_id','=','ejr.ed_id')
            ->where('ed.ed_id',$req->id)->get();
      return response()->json($equipment);
    }
    public function addEquipmentRequest(){
        DB::table('req_items_tbl')
          ->where('ejr_no',$_POST['id'])->insert([
            'req_items'=>$_POST['item'],
            'req_qty'=>$_POST['quantity'],
            'req_remark'=>$_POST['remarks'],
            'ejr_no'=>$_POST['id'],
        ]);//
      return back();
    }
	
  
	public function getReqDetails(Request $req){
        $type = DB::table('project_tbl as pr')->where('pr.proj_no',$req->id)
		->join('project_info_tbl','pr.proj_no','=','project_info_tbl.proj_no')
		->join('employee_tbl','project_info_tbl.emp_id','=','employee_tbl.emp_id')->get();
		return response()->json($type);
    }
	
	public function reqtimeext(){
		$proj_no = $_POST['proj-no'];
		$projdetails = DB::table('project_tbl as pr')->where('pr.proj_no',$proj_no)->get();
		foreach ($projdetails as $projdetails) {
    			$proj_end_date = $projdetails->proj_end_date;
    	}
        DB::table('timeext_request_tbl')->insert([
            'ter_date' => date_create('now'),
            'ter_days' => $_POST['ter-duration'],
            //'ter_amount' => $_POST['ter-amount'],
            'ter_reason' => $_POST['ter-reason'],
            'ter_original_enddate' => $proj_end_date,
            'ter_remarks' => $_POST['ter-remarks'],
            'proj_no' => $_POST['proj-no'],
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

	public function getProjectMilestone(Request $req){
        $type = DB::table('project_phase_tbl as pp')->where('pp.pp_id',$req->id)
			->join('project_tbl as pr','pr.proj_no','=','pp.proj_no')->get();
		return response()->json($type);
    }

	public function editProjectMilestone(){
        DB::table('project_tbl as pr')->join('project_phase_tbl as pp','pp.proj_no','=','pr.proj_no')
		->where('pp.pp_id',$_POST['id'])->where('pr.proj_no',$_POST['proj_no'])->update([
            'pp_start_date' => $_POST['pp_start_date'],
            'pp_end_date' => $_POST['pp_end_date'],
            ]);
			$id = $_POST['proj_no'];
        return redirect('/PM_project_edit?id='.$id);
    }



	//***** PM_TASK *****//
	public function ProjectTask(){
    $id = session('id');
		$task = DB::table('project_tbl as pr')
			->join('project_task_tbl as pt','pr.proj_no','=','pt.proj_no')
			->join('task_tbl','task_tbl.task_id','=','pt.task_id')
			->join('project_phase_tbl as pp','pt.pp_id','=','pp.pp_id')
			->join('project_info_tbl as pi','pi.proj_no','=','pr.proj_no')
            ->join('employee_tbl as emp','emp.emp_id','=','pi.emp_id')
			->where('deleted',0)
            ->where('pi.emp_id',$id)
			->orderBy('pp.pp_id')
			->orderBy('pt.pt_id')
			->orderBy('pt.pt_start_date')->get();
		$phase = DB::table('project_phase_tbl as pp')
			->join('phase_tbl','pp.phase_id','=','phase_tbl.phase_id')
			->join('project_tbl as pr','pr.proj_no','=','pp.proj_no')
			->join('project_info_tbl as pi','pr.proj_no','=','pi.proj_no')
            ->join('employee_tbl as emp','emp.emp_id','=','pi.emp_id')
			->where('pi.emp_id',$id)->get();
		$empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
        //notification
		$notif = DB::table('notification_tbl as notif')
			->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
			->where('notif.notif_to',$id)
			->orderBy('notif.notif_date', 'desc')
			->take(5)->get();
		
		$notifcount = DB::table('notification_tbl as notif')
			->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
			->where('notif.notif_to',$id)
			->where('notif.notif_pm_status','unview')->count();
		return view('PM_task',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount, 'task' => $task, 'phase' => $phase, 'empPic' => $empPic]);
	}



	//***** PM_PHASE *****//
	public function ProjectPhase(){
    $id = session('id');
        $var = DB::table('employee_tbl')->where('emp_id',$id)->get();
		$phase = DB::table('project_phase_tbl as pp')
			->join('phase_tbl','pp.phase_id','=','phase_tbl.phase_id')
			->join('project_tbl as pr','pr.proj_no','=','pp.proj_no')
			->join('project_info_tbl as pi','pr.proj_no','=','pi.proj_no')
            ->join('employee_tbl as emp','emp.emp_id','=','pi.emp_id')
			->where('deleted',0)
            ->where('pi.emp_id',$id)->get();
      
        $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
      //notification
		$notif = DB::table('notification_tbl as notif')
			->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
			->where('notif.notif_to',$id)
			->orderBy('notif.notif_date', 'desc')
			->take(5)->get();
		
		$notifcount = DB::table('notification_tbl as notif')
			->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
			->where('notif.notif_to',$id)
			->where('notif.notif_pm_status','unview')->count();
      
		return view('PM_phase',['id' => $id, 'notif' => $notif, 'notifcount' => $notifcount, 'phase'=> $phase, 'var' => $var,'empPic'=>$empPic]);
	}



	//***** PM_CALENDAR *****//
	public function ProjectCalendar(){
        //return session('message');
        $id = session('id');
        //$id = 1;
        $var = DB::table('employee_tbl')->where('emp_id',$id)->get();
        $empPic = DB::table('employee_tbl')->where('emp_id',$id)->get();
        
        //notification
		$notif = DB::table('notification_tbl as notif')
			->join('employee_tbl as emp','emp.emp_id','=','notif.notif_from')
			->where('notif.notif_to',$id)
			->orderBy('notif.notif_date', 'desc')
			->take(5)->get();
		
		$notifcount = DB::table('notification_tbl as notif')
			->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
			->where('notif.notif_to',$id)
			->where('notif.notif_pm_status','unview')->count();
		
      
		return view('PM_calendar',['empPic'=>$empPic,'var' => $var,'id' => $id, 'notif' => $notif, 'notifcount' => $notifcount]);
	}

	public function editCalProjTask(){
    $id = session('id');
    DB::table('project_task_tbl as pt')->where('pt.pt_id',$_POST['id'])
			->join('task_tbl','task_tbl.task_id','=','pt.task_id')->update([
            'pt_start_date' => $_POST['start_task'],
            'pt_end_date' => $_POST['end_task'],
            ]);

		return back();
	}

	public function MyTask(){
    $id = session('id');
		$task = DB::table('project_tbl as pr')
			->join('project_task_tbl as pt','pr.proj_no','=','pt.proj_no')
			->join('task_tbl','task_tbl.task_id','=','pt.task_id')
			->join('project_info_tbl as pi','pi.proj_no','=','pr.proj_no')
			->join('employee_tbl','pi.emp_id','=','employee_tbl.emp_id')
			->where('pi.emp_id',$id)->get();
		return response()->json($task);
	}

	//***** PM_TIMEEXTENSION *****//
	public function PM_timeextension(){
      $id = session('id');
		$var = DB::table('employee_tbl')->where('emp_id',$id)->get();
		
		//notifications
		$notif = DB::table('notification_tbl as notif')
			->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
			->where('notif.notif_to',$id)
			->where('notif.notif_pm_status','unview')->get();
		
		$notifcount = DB::table('notification_tbl as notif')
			->join('employee_tbl as emp','emp.emp_id','=','notif.notif_to')
			->where('notif.notif_to',$id)
			->where('notif.notif_pm_status','unview')->count();
			
		return view('PM_timeextension',['notif' => $notif, 'notifcount' => $notifcount, 'var' => $var]);
	}

	public function download(){
  $id = session('id');
	$phase = DB::table('project_phase_tbl as pp')
			->join('phase_tbl','pp.phase_id','=','phase_tbl.phase_id')
			->join('project_tbl as pr','pr.proj_no','=','pp.proj_no')
			->join('project_info_tbl as pi','pr.proj_no','=','pi.proj_no')
      ->join('employee_tbl','pi.emp_id','=','employee_tbl.emp_id')
			->where('pi.emp_id',$id)->get();
	        view()->share('phase',$phase);
			$pdf = PDF::loadView('PM_phase', $phase);
			// return $pdf->download('invoice.pdf');
			return $pdf->stream("Event_060697_4.pdf");
	}


}
