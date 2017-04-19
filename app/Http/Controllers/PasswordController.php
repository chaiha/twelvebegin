<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Sentinel;
use Session;
use App\User;
use App\Record;
use App\SelectRecord;
use App\LogAdminInsertRecord;
use App\YesRecords;
use App\SaleRecordYesCollection;
use Excel;
use Cookie;

class PasswordController extends Controller
{
     public function edit() {
        return view('passwords/reset');
    }

    public function update(Request $request) {
        $hasher = Sentinel::getHasher();

        $oldPassword = $request->input('old_password');
        $password = $request->input('password');
        $passwordConf = $request->input('password_confirmation');
        $user_id = $request->input('user_id');
        $user = Sentinel::findUserById($user_id);

        if (!$hasher->check($oldPassword, $user->password) || $password != $passwordConf) {
            Session::flash('error', 'Check input is correct.');
            return view('passwords/reset');
        }

        Sentinel::update($user, array('password' => $password));

        return redirect('/');
    }
}
