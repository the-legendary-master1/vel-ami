<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackEndController extends Controller
{
	public function __construct() 
	{
		$this->middleware('auth');
	}

	public function backendLandingPage($url_name)
	{
		return view('pages.back_end.landing_page');
	}
}
