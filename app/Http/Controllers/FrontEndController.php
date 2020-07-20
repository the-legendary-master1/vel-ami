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
use App\Events\GetProductReviews;
use App\Product;
use Carbon\Carbon;
use App\Tag;
use App\ProductReview;
use App\ProductImage;
use App\ReviewReply;
use App\ReportedReview;
use Intervention\Image\ImageManagerStatic as Image;

class FrontEndController extends Controller
{
	public function index()
	{
        $products = Product::with('shop')->orderBy('id', 'desc')->get();
		return view('pages.front_end.index', compact('products'));
	}
	public function viewProduct(Request $request, $name, $id)
	{
        $product = Product::with('shop')->find(base64_decode($id));
        $ratings = ProductReview::where('product_id', $product->id)->orderBy('rating', 'desc')->groupBy('rating');
        $rates = $ratings->select('rating', DB::raw('count(*) as total_rates'))->get();
        $stars = $ratings->select('rating', DB::raw( 'SUM(rating) as total_stars' ))->get();

        $average = 0;
        if ( $ratings->count() > 0 ) {
            $total_ratings = 0;
            foreach ($rates as $key => $value) {
                $total_ratings += $value->total_rates;
            }
            $total_stars = ($stars[0]->total_stars) + ($stars[1]->total_stars) + ($stars[2]->total_stars) + ($stars[3]->total_stars) + ($stars[4]->total_stars);

            $average = round($total_stars / $total_ratings, 1);
        }

        $reviews = ProductReview::with('user', 'reply', 'reply.user', 'product', 'product.shop', 'reported')->where('product_id', base64_decode($id))->orderBy('id', 'desc')->paginate(5);

        foreach ($reviews as $review) {
            $review->attachments = json_decode($review->attachments, true);
        }

		return view('pages.front_end.single_product', [
            'request' => $request,
            'product' => $product,
            'average' => $average,
            'reviews' => $reviews,
        ]);
    }
    public function chat()
    {
        return view('pages.front_end.chat');
    }
    public function viewShop(Request $request)
    {
        $shopId = base64_decode($request->id);
        $products = Product::where('my_shop_id', $shopId)->with('shop', 'images')->orderBy('id', 'desc')->get();

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
        $products = Product::with('images')->where('my_shop_id', $shopId)->orderBy('id', 'desc')->get();
        $shop = MyShop::find($shopId);
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
            // 'images.*'  => 'mimes:jpeg,jpg,png|required|max:2048',
            'tags.*'  => 'required',
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

                    if ( $request->hasFile('images') ) {
                        $shop = MyShop::find($request->my_shop_id);
                        $productId = ($request->id) ? $request->id : $product->id;

                        foreach ($request->file('images') as $key => $image) {
                            $product_images = new ProductImage;
                            $product_images->product_id = $productId;
                            $img_ext = $image->extension();
                            $filename = strtolower($shop->name) . '/' . $product->id . '/' . preg_replace('/\s+/', '_', $product->name) . '1024x800' . $product->id . date('is', strtotime(Carbon::now())) . $key;
                            $path =  $image->storeAs('products', $filename .'.'. $img_ext, 'public');

                            $img_resize = Image::make( $image->getRealPath() );
                            $img_resize->resize(1024, 800);
                            // $img_resize->resize(1024, 800, function ($constraint) {
                            //     $constraint->aspectRatio();
                            // });
                            $img_resize->save( 'files/' . $path );

                            // store product images
                            $product_images->path = 'files/' . $path;
                            $product_images->save();
                        }
                    }

                    if ($request->removeImages) {
                        $id =  explode(',', $request->removeImages);
                        $product = ProductImage::whereIn('id', $id)->delete();
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
                // if ( $request->hasFile('cover_photo') ) {
                $shop = MyShop::find($request->id);
                $cover_photo_file = $request->cover_photo;

                list($type, $cover_photo_file) = explode(':', $cover_photo_file);
                list(, $cover_photo_file) = explode(',', $cover_photo_file);

                $data = base64_decode($cover_photo_file);
                $filename = 'cover_photo_' . $request->id . date('is', strtotime(Carbon::now())) . '.png';
                $path = public_path('files/shop_img/');

                file_put_contents($path . $filename, $data);
                $shop->cover_photo = 'shop_img/' . $filename;
                $shop->save();



                    // $image_file = $request->file('cover_photo');
                    // $img_ext = $image_file->extension();
                    // $path = $shop->name . '/cover-photo/cover_photo_' . $shop->name . '_' . $request->id . date('is', strtotime(Carbon::now())) .'.'.$img_ext;
                    // $img_path = $request->cover_photo->storeAs('products', $path, 'public');

                    // $img_canvas = Image::canvas(900, 170);
                    // $image = Image::make( $image_file->getRealPath() );
                    // $image->resize(900, 170, function($constraint) {
                    //     $constraint->aspectRatio();
                    // });

                    // $img_canvas->insert($image, 'center');
                    // $img_canvas->save('files/' . $img_path);

                    // $shop->cover_photo = $img_path;
                    // $shop->save();
                // }

                event(new GetShops());
            }, 2);
        } catch (Exception $e) {
            return;
        }        
    }
    public function getReviews($id)
    {
        $reviews = ProductReview::with('user', 'reply', 'reply.user', 'product', 'product.shop', 'reported')->where('product_id', base64_decode($id))->orderBy('id', 'desc')->paginate(5);

        foreach ($reviews as $review) {
            $review->attachments = json_decode($review->attachments, true);
        }

        return response()->json($reviews);
    }
    public function storeUserReview(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required',
            'attachments.*' => 'mimes:jpeg,jpg,png|max:2048'
        ]);
        try {
            DB::transaction(function() use ($request) {
                $review = new ProductReview;
                $review->user_id = $request->user_id;
                $review->product_id = base64_decode($request->product_id);
                $review->comment = $request->comment;
                $review->rating = $request->rating;
                $review->status = 0;
                $review->save();

                if ( $request->hasFile('attachments') ) {
                    $attachments = ProductReview::find($review->id);
                        foreach ($request->file('attachments') as $key => $attachment) {
                            $img_ext = $attachment->extension();
                            $filename = 'attachment_' . $attachments->id . date('is', strtotime(Carbon::now())) . $key;
                            $path =  $attachment->storeAs('attachments', $filename .'.'. $img_ext, 'public');

                            // store attachments
                            $data['path'] = 'files/' . $path;
                            $arr[] = $data;
                        }
                    $attachments->attachments = json_encode($arr);
                    $attachments->save();
                }
            }, 2);
            event(new GetProductReviews());
        } catch (Exception $e) {
            return;
        }
    }
    public function storeReplyReview(Request $request)
    {
        try {
            DB::transaction(function() use ($request) {
                $reviewReply = new ReviewReply;
                $reviewReply->user_id = $request->user_id;
                $reviewReply->product_review_id = $request->review_id;
                $reviewReply->reply = $request->reply;
                $reviewReply->save();

            }, 2);
            event(new GetProductReviews());
        } catch (Exception $e) {
            return;
        }
    }
    public function reportReview(Request $request)
    {
        try {
            DB::transaction(function() use ($request) {
                $reportedReview = new ReportedReview;
                $reportedReview->product_review_id = $request->product_review_id;
                $reportedReview->user_id = $request->user_id;
                $reportedReview->save();

                $ctr = ReportedReview::where('product_review_id', $request->product_review_id)->get();

                if ($ctr->count() === 3) {
                    $deleted = ReportedReview::find($reportedReview->id);
                    $deleted->status = 'deleted';
                    $deleted->save();

                    $removeReportedReview = ProductReview::find($request->product_review_id);
                    $removeReportedReview->delete();
                }
            }, 2);
            event(new GetProductReviews());
        } catch (Exception $e) {
            return;
        }
    }
}
