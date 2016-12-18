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

    public function login(Request $request)
    {
    	 $email = $request->input('email');
    	 $password = $request->input('password');
    	 $credentials = [
    	 	'email' => $email,
    	 	'password' => $password,
    	 ];
    	 Sentinel::authenticate($credentials);
    	 return Sentinel::check();
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
