<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use Auth;
use App\Tag;
use App\User;
use App\MyShop;
use App\Category;
use Carbon\Carbon;
use App\Events\GetTags;
use App\Events\getUsers;
use App\Events\GetShops;
use Illuminate\Http\Request;
use App\Events\GetCategories;

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
	
	public function shops() {
		$shops = MyShop::all();
		return view('pages.back_end.shops', compact('shops'));
	}

	public function getShops()
	{
		return MyShop::all();
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

	public function tags()
	{
		$tags = Tag::all();
		return view('pages.back_end.tags', compact('tags'));
	}

	public function newTag(Request $req)
	{
		try {
			DB::transaction(function() use ($req) {
				$tag = new Tag;
				$tag->name = $req->name;
				$tag->save();
			}, 2);

			event(new GetTags());
		} catch (Exception $e) {
			return;
		}
	}

	public function updateTag(Request $req)
	{
		try {
			DB::transaction(function() use ($req) {
				$tag = Tag::find($req->id);
				$tag->name = $req->name;
				$tag->save();
			}, 2);

			event(new GetTags());
		} catch (Exception $e) {
			return;
		}
	}

	public function getTags()
	{
		return Tag::all();
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

	public function upgradeAccount(Request $req)
	{
		try {
			DB::transaction(function() use ($req) {
				$user = User::find($req->id);
				$user->role = 'User-Premium';
				$user->save();
			}, 2);

			event(new getUsers());
		} catch (Exception $e) {
			return;
		}
	}

	public function createShop(Request $req)
	{
		try {
			DB::transaction(function() use ($req) {
				$shop = new MyShop;
				$shop->user_id = Auth::user()->id;
				$shop->name = $req->shop_name;
				$shop->shop_url = str_replace(' ', '-', strtolower($req->shop_name));
				$shop->save();
			}, 2);

			$url = str_replace(' ', '-', strtolower($req->shop_name));
			
			return response()->json(['url_name' => Auth::user()->url_name, 'url' => $url]);
		} catch (Exception $e) {
			return response()->json(['message' => $e]);
		}
	}

	public function myShop($url_name, $shop_url)
	{
		$user = User::where('url_name', $url_name)->first();
		$shop = MyShop::where('shop_url', $shop_url)->first();
		$categories = Category::all();


		if($user && $shop) {
			return view('pages.back_end.my_shop', compact('shop', 'categories'));
		} else {
		    $data['title'] = '404';
		    $data['name'] = 'Page not found';
		    return response()->view('errors.404',$data,404);
		}
	}

	public function uploadShopIMG(Request $req)
	{
		try {
			DB::transaction(function() use ($req) {
				$shop = MyShop::find($req->id);
                    if ($req->hasFile('shop_img')) {
                        $shop_img_extension = $req->file('shop_img')->extension();
                        $shop_img_path = $req->shop_img->storeAs('shop_img', 'shop_img_' . $req->id . date('is', strtotime(Carbon::now())) . '.'.$shop_img_extension, 'public');
                        $shop->shop_img = $shop_img_path;
                    }
				$shop->save();
			}, 2);

			event(new GetShops());
		} catch (Exception $e) {
			return;
		}
	}

	public function getMyShop($id)
	{
		return MyShop::find($id);
	}

	public function updateShopDesc(Request $req)
	{
		try {
			DB::transaction(function() use ($req) {
				$shop = MyShop::find($req->id);
				$shop->desc = $req->desc;
				$shop->save();
			}, 2);
			
			event(new GetShops());
		} catch (Exception $e) {
			return;
		}
	}
}
