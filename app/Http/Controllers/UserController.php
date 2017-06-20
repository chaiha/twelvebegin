<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\User;	
use Session;

class UserController extends Controller
{

	public function create_user_admin()
	{
		$new_user =[
			'email' => 'ann@gmail.com',
			'password' => '1234',
			'first_name' => 'Ann',
			'last_name' => 'arwatchanakarn',
		];
		$register = Sentinel::registerAndActivate($new_user);
		$role = Sentinel::findRoleBySlug('admin');
		$role->users()->attach($register);

		echo "Finish";
	}

  public function create_user_admin_9()
  {
    for($i=1;$i<10;$i++)
     { 
    $new_user =[
      'email' => 'admin'.$i.'@gmail.com',
      'password' => '1234',
      'first_name' => 'first_sale'.$i,
      'last_name' => 'last_sale'.$i,
    ];
    $register = Sentinel::registerAndActivate($new_user);
    $role = Sentinel::findRoleBySlug('admin');
    $role->users()->attach($register);

    echo "Finish";
    }
  }

  public function create_user_sale()
  {
    for($i=1;$i<10;$i++)
     { 
    $new_user =[
      'email' => 'sale'.$i.'@gmail.com',
      'password' => '1234',
      'first_name' => 'first_sale'.$i,
      'last_name' => 'last_sale'.$i,
    ];
    $register = Sentinel::registerAndActivate($new_user);
    $role = Sentinel::findRoleBySlug('sale');
    $role->users()->attach($register);

    echo "Finish";
    }
  }
  public function create_user_super()
  {
    $new_user =[
      'email' => 'naunpun.m@gmail.com',
      'password' => '1234',
      'first_name' => 'ann',
      'last_name' => 'naunpun',
    ];
    $register = Sentinel::registerAndActivate($new_user);
    $role = Sentinel::findRoleBySlug('super');
    $role->users()->attach($register);

    echo "Finish";
  }

  public function activate_user($id)
  {
    $user = Sentinel::findById($id);

    $activation = Activation::create($user);
    echo "ok";
  }

    public function login(Request $request)
    {
    	 $email = $request->input('email');
    	 $password = $request->input('password');
    	 $credentials = [
    	 	'email' => $email,
    	 	'password' => $password,
    	 ];
    	 $user_available = Sentinel::authenticate($credentials);
       if($user_available!="")
       {
             $user = Sentinel::getUser();
             session(['user'=>$user]);
             if ($user->inRole('admin'))
              {
                return Redirect('/admin/checkupdate');
              }
            elseif($user->inRole('sale'))
            {
              return Redirect('/sale/home');
            }
            elseif($user->inRole('super'))
            {
              return Redirect('/super/home');
            }
       }
       else
       {
          Session::flash('message', 'E-mail หรือ Password ไม่ถูกต้อง กรุณากรอกใหม่'); 
          return redirect('/login');
       }
       
    }

    public function logout()
    {
      Session::forget('new_record');
      Session::forget('record');
      Session::forget('edit_record');
      Session::forget('mem_sale');
      Session::forget('mem_selected_record');
      Session::forget('mem_selected_record_list');
      Session::forget('mem_selected_record_extend');
      Session::forget('mem_selected_record_waiting');
      Session::forget('mem_selected_record_noreply');
      Session::forget('mem_selected_record_new');
      Session::forget('mem_selected_record_list_noreply');
      Session::forget('mem_selected_record_list_extend');
      Session::forget('mem_selected_record_list_waiting');
      Session::forget('mem_selected_record_list_new');
      Session::forget('preview_record_list_array');
      Session::forget('select_record_info');


      // session(['mem_selected_record_extend'
      //   session(['mem_selected_record_list_new'
      //sale
      Session::forget('user');
      Session::forget('sale_filled');
      Session::forget('select_record');
      Session::forget('sale_filled_edit');
      Session::forget('select_record_info');
      Session::forget('edit_record_info');
    	Sentinel::logout();
    	return Redirect('/login');
   }

   public function checkdi()
   {
   		if(Sentinel::check())
   		{
   			return Sentinel::check();	
   		}
   		else
   		{
   			echo "TEST";
   		}
   		
   }
}
