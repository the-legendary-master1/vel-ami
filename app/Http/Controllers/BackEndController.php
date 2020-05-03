<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\Events\GetCategories;
use DB;

class BackEndController extends Controller
{
	public function __construct() 
	{
		$this->middleware('auth');
	}

	public function dashboard()
	{
		return view('pages.back_end.dashboard');
	}

	public function backendLandingPage($url_name)
	{
		if(Auth::user()->url_name == $url_name) {
			return view('pages.back_end.profile');
		} else {
		    $data['title'] = '404';
		    $data['name'] = 'Page not found';
		    return response()->view('errors.404',$data,404);
		}
	}

	public function users() {
		return view('pages.back_end.users');
	}
	
	public function products() {
		return view('pages.back_end.products');
	}
	
	public function shops() {
		return view('pages.back_end.shops');
	}
	
	public function categories() {
		$categories = Category::all();

		return view('pages.back_end.categories', compact('categories'));
	}

	public function newCategory(Request $req)
	{
		try {
			DB::transaction(function() use ($req) {
				$category = new Category;
				$category->name = $req->name;
				$category->save();
			}, 2);

			event(new GetCategories());
		} catch (Exception $e) {
			return;
		}
	}

	public function getCategories()
	{
		return Category::all();
	}

	public function updateCategory(Request $req)
	{
		try {
			DB::transaction(function() use ($req) {
				$category = Category::find($req->id);
				$category->name = $req->name;
				$category->save();
			}, 2);

			event(new GetCategories());
		} catch (Exception $e) {
			return;
		}
	}
}
