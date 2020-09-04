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
use App\Chat;
use App\ChatAttachment;
use App\Events\GetMessages;
use App\Events\GetMessageNotifications;
use App\Events\GetUnreadNotifications;
use App\Events\ChatTyping;
use Intervention\Image\ImageManagerStatic as Image;

class FrontEndController extends Controller
{
	public function index()
	{
        $products = Product::with('shop:id,name', 'images:id,product_id,path', 'reviews:product_id,rating')->orderBy('id', 'desc')->paginate(18);
        
        foreach ($products as $product) {
            $product->images = json_decode($product->images, true);
        }

        $unreadNotification = 0;
        if (Auth::check()) {
            if (Auth::user()->role == "User-Premium")
                $unreadNotification = count( Chat::where('owner_id', Auth::user()->id)->where('owner_status', 0)->get()->groupBy('ref_id') );
            else
                $unreadNotification = count( Chat::where('customer_id', Auth::user()->id)->where('customer_status', 0)->get()->groupBy('ref_id') );
        }
		return view('pages.front_end.index', compact('products', 'unreadNotification'));
	}
	public function viewProduct(Request $request, $name, $id)
	{
        $product = Product::with('shop')->find($id);
        $unreadNotification = 0;
        $chat = [];

        if (Auth::check()) {
            $chat = Chat::where('customer_id', Auth::user()->id)->where('owner_id', $product->shop['user_id'])->where('product_id', $id)->get()->first();

            // if owner
            if (Auth::user()->role == "User-Premium")
                $unreadNotification = count( Chat::where('owner_id', Auth::user()->id)->where('owner_status', 0)->get()->groupBy('ref_id') );
            else
                $unreadNotification = count( Chat::where('customer_id', Auth::user()->id)->where('customer_status', 0)->get()->groupBy('ref_id') );
        }

        $reviews = ProductReview::with('user', 'reply', 'reply.user', 'product', 'product.shop', 'reported', 'category')->where('product_id', $id)->orderBy('id', 'desc')->paginate(5);

        foreach ($reviews as $review) {
            $review->attachments = json_decode($review->attachments, true);
        }

		return view('pages.front_end.single_product', [
            'unreadNotification' => $unreadNotification,
            'request' => $request,
            'product' => $product,
            'reviews' => $reviews,
            'chat' => $chat,
        ]);
    }
    public function viewShop(Request $request, $name)
    {
        $shopId = base64_decode($request->id);
        $products = Product::where('my_shop_id', $shopId)->with('shop', 'images')->orderBy('id', 'desc')->get();

        foreach ($products as $product) {
            $product->images = json_decode($product->images, true);
        }

        $unreadNotification = 0;
        if (Auth::check()) {
            if (Auth::user()->role == "User-Premium")
                $unreadNotification = count( Chat::where('owner_id', Auth::user()->id)->where('owner_status', 0)->get()->groupBy('ref_id') );
            else
                $unreadNotification = count( Chat::where('customer_id', Auth::user()->id)->where('customer_status', 0)->get()->groupBy('ref_id') );
        }

        $shop = MyShop::find($shopId);
        $categories = Category::all();
        return view('pages.front_end.single_shop', compact('products', 'categories', 'shop', 'unreadNotification'));
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

        foreach ($products as $product) {
            $product->images = json_decode($product->images, true);
        }

        $shop = MyShop::find($shopId);
        $categories = Category::all();

        $unreadNotification = 0;
        if (Auth::check()) {
            if (Auth::user()->role == "User-Premium")
                $unreadNotification = count( Chat::where('owner_id', Auth::user()->id)->where('owner_status', 0)->get()->groupBy('ref_id') );
            else
                $unreadNotification = count( Chat::where('customer_id', Auth::user()->id)->where('customer_status', 0)->get()-> groupBy('ref_id') );
        }

        if ($products) {
            return view('pages.front_end.single_shop', compact('products', 'categories', 'shop', 'unreadNotification'));
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
        $tags = [];

        if (strlen($search) > 3) {
            if ($search != '') {
                if ($selected != '') {
                    $tags = Tag::where('name', 'LIKE', $search. '%')->whereNotIn('name', $selected)->take(20)->get();
                }
                else {
                    $tags = Tag::where('name', 'LIKE', $search. '%')->take(20)->get();
                }
            }
            else {
                if ($selected != '') {
                    $tags = Tag::whereNotIn('name', $selected)->take(20)->get();
                }
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
                $product->url = str_replace(' ', '-', $request->name);
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


                event(new GetShops());
            }, 2);
        } catch (Exception $e) {
            return;
        }        
    }
    public function getReviews($id)
    {
        $reviews = ProductReview::with('user', 'reply', 'reply.user', 'product', 'product.shop', 'reported')->where('product_id', $id)->orderBy('id', 'desc')->paginate(5);

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
                $review->product_id = $request->product_id;
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

                $ratings = ProductReview::where('product_id', $request->product_id)->orderBy('rating', 'desc')->groupBy('rating');
                $rates = $ratings->select('rating', DB::raw('count(*) as total_rates'))->get();
                $stars = $ratings->select('rating', DB::raw( 'SUM(rating) as total_stars' ))->get();

                $average = 0;
                if ( $ratings->count() > 0 ) {

                    $dataRatings = [];
                    foreach ($rates as $key => $value) {
                        $dataRatings[] = $value->total_rates;
                    }

                    $total_ratings = array_sum($dataRatings);
                    $dataStars = [];
                    foreach ($stars as $key => $star) {
                        $dataStars[] = $stars[$key]->total_stars;
                    }
                    $total_stars = array_sum($dataStars);
                    $average = round($total_stars / $total_ratings, 1);
                }

                $product = Product::find($request->product_id);
                $product->total_rating = $average;
                $product->save();
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
    public function chat(Request $request, $name, $product_id)
    {   
        $product = Product::find($product_id);
        $messages = Chat::with('user', 'attachments')->where('product_id', $product_id)->where('ref_id', $request->ref)->get();

        $customer_id = Auth::user()->id;
        $owner_id = $product->shop->user_id;

        // if owner
        $unreadNotification = 0;
        if (Auth::check()) {
            if ($owner_id == $customer_id)
                $unreadNotification = count( Chat::where('owner_id', Auth::user()->id)->where('owner_status', 0)->get()->groupBy('ref_id') );
            else
                $unreadNotification = count( Chat::where('customer_id', Auth::user()->id)->where('customer_status', 0)->get()->groupBy('ref_id') );
        }

        $checkMessage = Chat::where('product_id', $product_id)->where('ref_id', $request->ref)->count();
        if ($checkMessage > 0) {
            $msgs = Chat::where('product_id', $product_id)->where('ref_id', $request->ref)->select('customer_id', 'owner_id')->get();

            $customer_id;
            $owner_id;
            foreach ($msgs as $msg) {
                if ($msg->customer_id != $msg->owner_id) {
                    $customer_id = $msg->customer_id;
                    $owner_id = $msg->owner_id;
                    break;
                }
            }    
        } 
        
        // for owner
        $user = User::find($customer_id);

        // for cusutomer
        if ($customer_id == Auth::user()->id)
            $user = User::find($owner_id);

        if ($user->isOnline())
            $user->status = 'online';
        else
            $user->status = 'offline';

        return view('pages.front_end.chat', [
            'unreadNotification' => $unreadNotification,
            'product_id'         => $product_id,
            'owners_id'          => $product->shop->user_id,
            'messages'           => $messages,
            'request'            => $request,
            'user'               => $user,
        ]);
    }
    public function checkUserStatus($productId, $ref_id)
    {
        $checkMessage = Chat::where('product_id', $productId)->where('ref_id', $ref_id)->count();
        $user = [];
        if ($checkMessage > 0) {
            $messages = Chat::where('product_id', $productId)->where('ref_id', $ref_id)->select('customer_id', 'owner_id')->get();
            $customer_id;
            $owner_id;
            foreach ($messages as $message) {
                if ($message->customer_id != $message->owner_id) {
                    $customer_id = $message->customer_id;
                    $owner_id = $message->owner_id;
                    break;
                }
            }        
            // for owner
            $user = User::find($customer_id);

            // for cusutomer
            if ($customer_id == Auth::user()->id)
                $user = User::find($owner_id);

            if ($user->isOnline())
                $user->status = 'online';
            else
                $user->status = 'offline';
        }

        return response()->json($user);
    }
    public function storeMessage(Request $request)
    {
        try {
            DB::transaction(function() use ($request) {
                $chat = new Chat;
                $chat->product_id = $request->product_id;
                $chat->owner_id = $request->owner_id;
                $chat->customer_id = $request->customer_id;
                $chat->message = $request->message;
                $chat->owner_status = 0; // customer sent, owner will get msg notif
                $chat->customer_status = 1;
                if ( $request->owner_id == $request->customer_id ) {
                    $chat->customer_status = 0; // owner sent, customer will get msg notif
                    $chat->owner_status = 1;
                }
                $chat->ref_id = $request->ref_id;
                $chat->save();

                if ( $request->hasFile('attachments') ) {
                    foreach ($request->file('attachments') as $key => $attachment) {
                            $img_ext = $attachment->extension();
                            $filename = 'attachment_' . $chat->id . date('is', strtotime(Carbon::now())) . $key;
                            $path =  $attachment->storeAs('attachments', $filename .'.'. $img_ext, 'public');

                        $attachments = new ChatAttachment;
                        $attachments->chat_id = $chat->id;
                        $attachments->path = 'files/' . $path;
                        $attachments->save();
                    }
                }
                if ( $request->owner_id == $request->customer_id )
                    $unreadNotification = count( Chat::where('owner_status', 0)->get()->groupBy('ref_id') );
                else
                    $unreadNotification = count( Chat::where('customer_status', 0)->get()->groupBy('ref_id') );

                $checkMessage = Chat::where('product_id', $request->product_id)->where('ref_id', $request->ref_id)->count();
                if ($checkMessage > 0) {
                    $msgs = Chat::where('product_id', $request->product_id)->where('ref_id', $request->ref_id)->select('customer_id', 'owner_id')->get();
                    $customer_id;
                    $owner_id;
                    foreach ($msgs as $msg) {
                        if ($msg->customer_id != $msg->owner_id) {
                            $customer_id = $msg->customer_id;
                            $owner_id = $msg->owner_id;
                            break;
                        }
                    }
                    // if owner
                    if ($owner_id == Auth::user()->id)
                        $user = User::select('id')->find($customer_id);
                    else
                        $user = User::select('id')->find($owner_id);
                }

                event( new GetMessages( $chat->load('user', 'attachments:chat_id,path') ));
                event( new GetUnreadNotifications( $unreadNotification, $user ));
            }, 2);
        } catch (Exception $e) {
            return;
        }
    }
    public function isTyping(Request $request)
    {
        try {
            $customer = Chat::where('product_id', $request->product_id)->where('ref_id', $request->ref_id)->count();

            if ($customer > 0) {
                $user = User::find($request->auth_id);
                $user['ref'] = $request->ref_id;
                event(new ChatTyping( $user ));
            }
        } catch (Exception $e) {
            return;
        }
    }
    public function getMessages(Request $request)
    {
        try {
            DB::transaction(function() use ($request) {
                $user = User::find($request->id);

                $chats = Chat::with('product:id,name,price,url', 'product.image:product_id,path', 'user:id')->orderBy('id', 'desc')->select('id','product_id','customer_id','owner_id','owner_status','customer_status','ref_id')->get();

                if ($user->role == "User-Premium")
                    $messages = $chats->where('owner_id', $request->id)->groupBy(['ref_id', 'owner_status']);
                else 
                    $messages = $chats->where('customer_id', $request->id)->groupBy(['ref_id', 'customer_status']);

                event( new GetMessageNotifications( $messages, $user->id ));
            }, 2);
        } catch (Exception $e) {
            return;
        }
    }
    public function readMessage(Request $request)
    {
        try {
            DB::transaction(function() use ($request) {
                $checkMessage = Chat::where('product_id', $request->product_id)->where('ref_id', $request->ref_id)->count();

                $unreadNotification = [];
                $user = [];
                if ($checkMessage > 0) {
                    $msgs = Chat::where('product_id', $request->product_id)->where('ref_id', $request->ref_id)->select('customer_id', 'owner_id')->get();
                    $customer_id;
                    $owner_id;
                    foreach ($msgs as $msg) {
                        if ($msg->customer_id != $msg->owner_id) {
                            $customer_id = $msg->customer_id;
                            $owner_id = $msg->owner_id;
                            break;
                        }
                    }    

                    $messages = Chat::where('ref_id', $request->ref_id)->get();
                    // if owner
                    if ($owner_id == Auth::user()->id) {
                        foreach ($messages as $message) {
                            $message->owner_status = 1; // seen owner side 
                            $message->save();
                        }
                        $unreadNotification = count( Chat::where('owner_id', Auth::user()->id)->where('owner_status', 0)->get()->groupBy('ref_id') );
                        $user = User::select('id')->find($owner_id);
                    }
                    else {
                        foreach ($messages as $message) {
                            $message->customer_status = 1; // seen customer side
                            $message->save();
                        }
                        $unreadNotification = count( Chat::where('customer_id', Auth::user()->id)->where('customer_status', 0)->get()->groupBy('ref_id') );
                        $user = User::select('id')->find($customer_id);
                    }
                }

                event( new GetUnreadNotifications( $unreadNotification, $user ));
            }, 2);
        } catch (Exception $e) {
            return;
        }
    }
}
