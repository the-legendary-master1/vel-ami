<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Hash;
use App\User;
use Redirect;
use Validator;
use App\MyShop;
use App\Category;
use Illuminate\Http\Request;
use App\Events\GetCategories;
use App\Events\GetProducts;
use App\Product;
use App\Tag;

class FrontEndController extends Controller
{
	public function index()
	{
        $products = Product::with('shop')->orderBy('id', 'desc')->get();
		return view('pages.front_end.index', compact('products'));
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
        $products = [];
        return view('pages.front_end.single_shop', compact('products'));
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
            // 'g-recaptcha-response' => 'required|captcha',
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
                return response()->json([ 'message' => 'Success' ]);
            } 
            else {
                return response()->json([ 'message' => 'Error' ]);
            }
        } catch (Exception $e) {
            return response()->json([ 'message' => 'Error' ]);
        }
    }
    public function shop($shop_url, $shopId)
    {
        $shopId = base64_decode($shopId);
        $products = Product::where('my_shop_id', $shopId)->orderBy('id', 'desc')->get();
        $shop = MyShop::where('shop_url', $shop_url)->where('user_id', $shopId)->first();
        $categories = Category::all();


        if ($products) {
            return view('pages.front_end.single_shop', compact('products', 'categories'));
        } else {
            $data['title'] = '404';
            $data['name'] = 'Page not found';
            return response()->view('errors.404',$data,404);
        }
    }
    public function getProducts(Request $request)
    {   
        return Product::where('my_shop_id', $request->id)->with('shop')->orderBy('id', 'desc')->get();
        // return Product::with('shop')->get();
    }
    public function searchTags(Request $request)
    {
        $search = $request->get('search');
        $selected = $request->get('selected');
        $tags = Tag::all();

        if ($search != '') {
            if ($selected != '') {
                $tags = Tag::where('name', 'LIKE', '%' .$search. '%')->whereNotIn('name', $selected)->get();
            }
            else {
                $tags = Tag::where('name', 'LIKE', '%' .$search. '%')->get();
            }
        }
        else {
            if ($selected != '') {
                $tags = Tag::whereNotIn('name', $selected)->get();
            }
        }
        return $tags;
    }
    public function storeProduct(Request $request)
    {
        $this->validate($request, [
            'category'  => 'required',
            'subcategory'  => 'required',
            'name' => 'required',
            'price'  => 'required',
            'description'  => 'required',
            'details'  => 'required',
            'thumbnail'  => 'required',
            'tags'  => 'required',
        ]);

        try {
            DB::transaction(function() use ($request) {

                if ($request->id) {
                    $product = Product::find($request->id);
                }
                else {
                    $product = new Product;
                }

                $product->my_shop_id = $request->my_shop_id;
                $product->category = $request->category;
                $product->sub_category = $request->subcategory;
                $product->name = $request->name;
                $product->price = $request->price;
                $product->description = $request->description;
                $product->details = $request->details;
                $product->tags = implode(',', $request->tags);
                $product->save();

                $productThumb = Product::find($product->id);
                    if ( $request->hasFile('thumbnail') ) {
                        $shop = MyShop::find($request->my_shop_id);
                        $img_ext = $request->file('thumbnail')->extension();
                        $fakepath = $shop->name . '/' . $product->id . '/' . preg_replace('/\s+/', '_', $product->name) . '_thumbnail{' . $shop->name . '}.' . $img_ext;
                        $img_path = $request->thumbnail->storeAs('products', $fakepath, 'public');

                        $productThumb->thumbnail = 'files/' . $img_path;
                    }
                $productThumb->save();
            }, 2);

            event(new GetProducts());
        } catch (Exception $e) {
            return;
        }
    }
    public function selectedProducts(Request $request)
    {
        return Product::whereIn('id', $request->ids)->get();
    }
    public function deleteSelectedProducts(Request $request)
    {
        try {
            DB::transaction(function() use($request) {
                Product::whereIn('id', $request->ids)->delete();
            }, 2);

            event(new GetProducts());
        } catch (Exception $e) {
            return;
        }
    }
}
