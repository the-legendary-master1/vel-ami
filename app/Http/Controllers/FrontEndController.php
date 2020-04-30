<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Redirect;
use Hash;

class FrontEndController extends Controller
{
	public function index()
	{
		return view('pages.front_end.index');
	}

	public function signUp(Request $req)
	{
        $this->validate($req, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        $user = new User;
        $user->name = $req->first_name.' '.$req->last_name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();

		Auth::login($user);
		return Redirect::to('home');
	}
}
