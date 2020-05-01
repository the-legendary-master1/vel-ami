<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
