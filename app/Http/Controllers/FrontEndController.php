<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use App\User;
use Redirect;
use Validator;
use App\MyShop;
use App\Category;
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
    public function chat()
    {
        return view('pages.front_end.chat');
    }
    public function viewShop()
    {
        return view('pages.front_end.single_shop');
    }
    public function profile()
    {
        return view('pages.front_end.profile');
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
        $user->f_name = $req->first_name;
        $user->l_name = $req->last_name;
        $user->email = $req->email;
        $user->role = 'User';
        $user->secret = encrypt($req->password);
        $user->password = Hash::make($req->password);
        $user->url_name = str_replace(' ', '-', strtolower($req->first_name.' '.$req->last_name));
        $user->save();

		Auth::login($user);
	}
    public function loginUser(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required',
                'password'  => 'required',
            ]);
            if ( Auth::attempt( ['email' => $request->email, 'password' => $request->password] , true) ){
                Auth::login($user);
            } 
            else {
                return response()->json([ 'message' => 'Error' ]);
            }
        } catch (Exception $e) {
            return response()->json([ 'message' => 'Error' ]);
        }
    }

    public function shop($shop_url)
    {
        $shop = MyShop::where('shop_url', $shop_url)->first();
        $categories = Category::all();


        if($shop) {
            return view('pages.back_end.my_shop', compact('shop', 'categories'));
        } else {
            $data['title'] = '404';
            $data['name'] = 'Page not found';
            return response()->view('errors.404',$data,404);
        }
    }
}
