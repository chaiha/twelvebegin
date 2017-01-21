<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use User;	

class UserController extends Controller
{

	public function create_user()
	{
		$new_user =[
			'email' => 'chai@gmail.com',
			'password' => '1234',
			'first_name' => 'suphamongkhon',
			'last_name' => 'arwatchanakarn',
		];
		$register = Sentinel::registerAndActivate($new_user);
		$role = Sentinel::findRoleBySlug('admin');
		$role->users()->attach($register);

		echo "Finish";
	}

  public function create_user_sale()
  {
    for($i=2;$i<10;$i++)
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
       if ($user->inRole('admin'))
        {
          return Redirect('/admin/home');
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
