<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class LoginController extends Controller
{
    public function checkLogin(){
      $id = session('id');
      if(session()->has('id')){
        $user = DB::table('users')->where('emp_id',$id)->get();
        foreach($user as $user){
          if($user->el_position == 'Admin'){
            session()->forget('again');
            return redirect('/indexAdmin');
          }else{
            session()->forget('again');
            return redirect('/indexProjectManager');
          }//if else
        }//foreach
        //echo $id."login";
      }else{
        return view('loginadmin');
        //echo $id."logout";
      }//if else
    }//check log in if exist
    public function doLogin(Request $req){
        $user = $req->input('user');
        $pass = $req->input('pass');
        $type = $req->input('loginType');
        if(Auth::attempt(['username' => $user ,'password'=> $pass ,'el_position'=> $type])){
          $getid = DB::table('users')->where('username','=',$user,'AND','password','=',$pass,'AND','el_position','=',$type)->get();
          foreach($getid as $getid){
            $id = $getid->emp_id;
          }
          $name = DB::table('employee_tbl')->where('emp_id',$id)->get();
          foreach($name as $name){
            $Name = $name->emp_first_name." ".$name->emp_middle_initial." ".$name->emp_last_name;
          }
          session(['id'=>$id]);
          session()->flash('message','Welome '.$Name);

            if ($type == 'Admin') {
              return redirect('/indexAdmin');
            } else {
              return redirect('/indexProjectManager');
            }
            //echo "hi";
        }else{
           session()->flash('again','Wrong Username and/or Password or Employee Position.');
           return redirect('/');
           //echo "wrong";
        }
    }

    public function doRegister(){
        DB::table('employee_login_tbl')->insert(
            [
            'el_user' => $_POST['username'],
            'el_pass' => bcrypt($_POST['password']),
            // 'remember_token' => $_POST['_token'],
            'el_position' => $_POST['position'],
            ]
        );
        return redirect('/');
    }
}
