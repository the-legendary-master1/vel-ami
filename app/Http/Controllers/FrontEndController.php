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
use App\Events\GetShops;
use App\Product;
use Carbon\Carbon;
use App\Tag;
use Intervention\Image\ImageManagerStatic as Image;

class FrontEndController extends Controller
{
	public function index()
	{
        $products = Product::with('shop')->orderBy('id', 'desc')->get();
		return view('pages.front_end.index', compact('products'));
	}
	public function viewProduct($name, $id)
	{
        $product = Product::find(base64_decode($id));
		return view('pages.front_end.single_product', compact('product'));
    }
    public function chat()
    {
        return view('pages.front_end.chat');
    }
    public function viewShop(Request $request)
    {
        $shopId = base64_decode($request->id);
        $products = Product::where('my_shop_id', $shopId)->with('shop')->orderBy('id', 'desc')->get();

        foreach ($products as $product) {
            $product->images = json_decode($product->images, true);
        }

        $shop = MyShop::find($shopId);
        $categories = Category::all();
        return view('pages.front_end.single_shop', compact('products', 'categories', 'shop'));
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
        $shop = MyShop::where('shop_url', $shop_url)->where('user_id', $shopId)->get()->first();
        $categories = Category::all();

        if ($products) {
            return view('pages.front_end.single_shop', compact('products', 'categories', 'shop'));
        } else {
            $data['title'] = '404';
            $data['name'] = 'Page not found';
            return response()->view('errors.404',$data,404);
        }
    }
    public function getProducts(Request $request)
    {   
        $products = Product::where('my_shop_id', $request->id)->with('shop')->orderBy('id', 'desc')->get();

        foreach ($products as $product) {
            $product->images = json_decode($product->images, true);
        }

        return $products;
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
            'images'  => 'required',
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
                $product->category_id = $request->category;
                $product->sub_category_id = $request->subcategory;
                $product->name = $request->name;
                $product->price = $request->price;
                $product->description = $request->description;
                $product->details = $request->details;
                $product->tags = implode(',', $request->tags);
                $product->save();

                
                    // if ( $request->hasFile('thumbnail') ) {
                    //     $image = $request->file('thumbnail');
                    //     $img_ext = $image->extension();

                    //     $fakepath = $shop->name . '/' . $product->id . '/' . preg_replace('/\s+/', '_', $product->name) . '_thumbnail_1024x768_' . $product->id . date('is', strtotime(Carbon::now())) . '.' .$img_ext;
                    //     $path =  $request->thumbnail->storeAs('products', $fakepath, 'public');

                    //     $img_resize = Image::make( $image->getRealPath() );
                    //     $img_resize->resize(1024, 768);
                    //     $img_resize->save( 'files/' . $path );

                    //     $images->thumbnail = 'files/' . $path;
                    // }
                    if ( $request->hasFile('images') ) {
                        $shop = MyShop::find($request->my_shop_id);
                        $images = Product::find($product->id);
                            foreach ($request->file('images') as $key => $image) {
                                $img_ext = $image->extension();
                                $filename = strtolower($shop->name) . '/' . $product->id . '/' . preg_replace('/\s+/', '_', $product->name) . '_1024x768_' . $product->id . date('is', strtotime(Carbon::now())) . $key;
                                $path =  $image->storeAs('products', $filename .'.'. $img_ext, 'public');

                                $img_resize = Image::make( $image->getRealPath() );
                                $img_resize->resize(1024, 768);
                                $img_resize->save( 'files/' . $path );
                                $img_size = $img_resize->filesize();
                                $img_type = $img_resize->mime();

                                $images->images = 'files/' . $path;
                                $data['path'] = $images->images;
                                $data['name'] = $filename;
                                $data['type'] = $img_type;
                                $data['size'] = $img_size;

                                $arr[] = $data;
                            }
                        $images->images = json_encode($arr);
                        $images->save();
                    }

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
    public function updateCoverPhoto(Request $request)
    {
        try {
            DB::transaction(function() use ($request) {
                if ( $request->hasFile('cover_photo') ) {
                    $shop = MyShop::find($request->id);
                    $img_ext = $request->file('cover_photo')->extension();
                    $path = $shop->name . '/cover-photo/cover_photo_' . $shop->name . '_' . $request->id . date('is', strtotime(Carbon::now())) .'.'.$img_ext;
                    $img_path = $request->cover_photo->storeAs('products', $path, 'public');

                    $shop->cover_photo = $img_path;
                    $shop->save();
                }

                event(new GetShops());
            }, 2);
        } catch (Exception $e) {
            return;
        }        
    }
}
