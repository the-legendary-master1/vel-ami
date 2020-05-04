<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\Events\GetCategories;
use App\Events\getUsers;
use DB;
use App\User;
use Hash;
use Carbon\Carbon;

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
			$user = User::where('url_name', $url_name)->first();
			$user->secret = decrypt($user->secret);

			return view('pages.back_end.profile', compact('user'));
		} else {
		    $data['title'] = '404';
		    $data['name'] = 'Page not found';
		    return response()->view('errors.404',$data,404);
		}
	}

	public function users() {
		$users = User::all();

		return view('pages.back_end.users', compact('users'));
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

	public function getUsers()
	{
		return User::all();
	}

	public function getUser($id) {
		$user = User::find($id);
		$user->secret = decrypt($user->secret);

		return $user;
	}

	public function updateProfileField(Request $req)
	{
		try {
			DB::transaction(function() use ($req) {
				$user = User::find($req->id);
		        $user->name = $req->f_name.' '.$req->l_name;
		        $user->f_name = $req->f_name;
		        $user->m_name = $req->m_name;
		        $user->l_name = $req->l_name;
		        $user->email = $req->email;
		        $user->secret = encrypt($req->secret);
		        $user->password = Hash::make($req->secret);
		        $user->url_name = str_replace(' ', '-', strtolower($req->f_name.' '.$req->l_name));
		        $user->save();

			}, 2);

			event(new getUsers());
			return User::find($req->id);
		} catch (Exception $e) {
			return;
		}
	}

	public function uploadProfileImg(Request $req)
	{
		try {
			DB::transaction(function() use ($req) {
				$user = User::find($req->id);
                    if ($req->hasFile('img_path')) {
                        $img_path_extension = $req->file('img_path')->extension();
                        $img_path_path = $req->img_path->storeAs('img_path', 'img_path_' . $req->id . date('is', strtotime(Carbon::now())) . '.'.$img_path_extension, 'public');
                        $user->img_path = $img_path_path;
                    }
				$user->save();
			}, 2);

			event(new getUsers());
		} catch (Exception $e) {
			return;
		}
	}
}
