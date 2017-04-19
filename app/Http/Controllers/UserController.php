<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\User;	

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
    	 Sentinel::authenticate($credentials);
    	 //$user = Sentinel::check();
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

    public function logout()
    {
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
