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

	public function viewProduct($id)
	{
		return view('pages.front_end.single_product');
    }

	public function signUp(Request $req)
	{
        $this->validate($req, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        $user = new User;
        $user->name = $req->first_name.' '.$req->last_name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();

		Auth::login($user);

	}
}
