<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class BackEndController extends Controller
{
	public function __construct() 
	{
		$this->middleware('auth');
	}

	public function backendLandingPage($url_name)
	{
		if(Auth::user()->url_name == $url_name) {
			return view('pages.back_end.landing_page');
		} else {
		    $data['title'] = '404';
		    $data['name'] = 'Page not found';
		    return response()->view('errors.404',$data,404);
		}
	}
}
