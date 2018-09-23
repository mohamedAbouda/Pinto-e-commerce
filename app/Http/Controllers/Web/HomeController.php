<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SubscribeRequest;
use App\Http\Requests\Web\SupportMessageRequest;
use App\Http\Requests\Web\PasswordForgetRequest;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Discount;
use App\Models\Subscriber;
use App\Models\PasswordReset;
use App\Models\SupportMessage;
use App\Models\Banner;
use App\Models\User;
use App\Models\Page;
use App\Models\Category;
use App\Models\StoreLocation;
use App\Models\Merchant;
use App\Models\Client;
use App\Notifications\ForgetPassword;
use League\Csv\Reader;
use League\Csv\Writer;
use Carbon\Carbon;
use Mapper;
use Alert;
use Auth;
use DB;

require 'vendor/league/csv/autoload.php';

class HomeController extends Controller
{
    public function index()
    {
        $data['slider_sheets'] = Slider::get();
        $banners = Banner::where('active' ,1)->inRandomOrder()->get();
        $data['banners_under_slider'] = $banners->filter(function ($item) {
            return strpos($item->position ,'Home page under main slider') !== FALSE;
        });
        $data['banners_middle'] = $banners->filter(function ($item) {
            return strpos($item->position ,'Home page in the middle') !== FALSE;
        });
        $data['featured'] = Product::with(['discount' ,'subCategory'])->where('featured' ,3)->orderBy('id' ,'DESC')->get();
        $data['sections'] = Category::with('subCategories')->inRandomOrder()->take(3)->get()->values();
        foreach ($data['sections'] as $section) {
            $sub_category_ids = $section->subCategories->pluck('id')->toArray();
            $section->objects['best_selling'] = Product::with(['discount' ,'subCategory'])->whereIn('sub_category_id' ,$sub_category_ids)
            ->select('products.*' ,DB::raw('COUNT(order_product.id) as selling_count'))
            ->join('order_product' ,'order_product.product_id' ,'=' ,'products.id')
            ->groupBy('products.id')->orderBy('selling_count' ,'DESC')
            ->orderBy('id' ,'DESC')->take(16)->get();
            $section->objects['new_products'] = Product::with(['discount' ,'subCategory'])->whereIn('sub_category_id' ,$sub_category_ids)->orderBy('id' ,'DESC')->take(16)->get();
            $section->objects['most_seen'] = Product::with(['discount' ,'subCategory'])->whereIn('sub_category_id' ,$sub_category_ids)->orderBy('views' ,'DESC')->take(16)->get();
            $section->objects['discounts'] = Product::with(['discount' ,'subCategory'])->whereIn('sub_category_id' ,$sub_category_ids)->take(16)->get()->filter(function ($item) {
                return $item->discount != NULL;
            });
            $section->objects['top_rated'] = Product::with(['discount' ,'subCategory'])->whereIn('sub_category_id' ,$sub_category_ids)
            ->select('products.*' ,'product_review.rate')
            ->join('product_review' ,'product_id' ,'=' ,'products.id')->orderBy('product_review.rate' ,'DESC')
            ->take(16)->get();
            // $section->objects['best_selling'] = [];
            // dd($section->objects);
        }
        // dd($data['sections']);

        return view('site.index.index' ,$data);
    }

    public function offers()
    {
        $now = Carbon::now();
        $data['new_arrivals'] = Product::where('created_at' ,'>' , $now->subMonth()->toDateTimeString())
        ->orderBy('id' ,'DESC')->take(10)->get();
        if (request()->has('today')) {
            $data['discounts'] = Product::where('created_at' ,'>' , Carbon::now()->subDay()->toDateTimeString())->whereHas('discount',function($q){
                $q->where('activation_end' ,'>=' ,Carbon::now()->toDateTimeString())->where('activation_start' ,'<=' ,Carbon::now()->toDateTimeString());
            })->paginate(12);
        }else {
            $data['discounts'] = Product::whereHas('discount',function($q){
                $q->where('activation_end' ,'>=' ,Carbon::now()->toDateTimeString())->where('activation_start' ,'<=' ,Carbon::now()->toDateTimeString());
            })->paginate(12);
        }
        $data['page'] = request()->get('page' ,1);
        $data['offset'] = $data['page'] * 12 - 12;
        $data['up_to'] = $data['page'] * 12;

        return view('site.offers' ,$data);
    }



    public function contact(SupportMessageRequest $request)
    {
        $message = SupportMessage::create($request->all());
        if ($message) {
            return redirect()->back()->with('success' , "Message sent successfully.");
        }
        return redirect()->back()->withErrors(["Something went wrong ! please try again."]);
    }

    public function subscribe(SubscribeRequest $request)
    {
        if (Subscriber::where('email' , $request->get('subemail'))->first()) {
            return redirect()->back()->withErrors(['error' => 'Email already exists !']);
        }
        Subscriber::create(['email' => $request->get('subemail')]);
        return redirect()->back()->with('success' , "Subscribed successfully.");
    }

    // public function mailTest()
    // {
    //     $user = \Auth::user();
    //     if (!$user) {
    //         return response()->json(['error' => 'not logged in']);
    //     }
    //     $user->notify(new ForgetPassword());
    // }


    public function getPage($page)
    {
        $data['page'] = Page::where('encoded_title' , $page)->first();

        if (!$data['page']) {
            return abort(404);
        }
        $data['active'] = "#$page";
        return view('web.page' , $data);
    }

    public function count()
    {

    }

    public function csv()
    {
        $data['product_columns'] = Product::$columns;
        $reader = Reader::createFromPath(public_path('uploads/sample.csv'), 'r');
        $all_rows = $reader->fetchAll();
        if (count($all_rows) > 0) {
            $data['first_row'] = $all_rows[0];
        }
        return view('web.csv' , $data);
    }

    public function map(Request $request)
    {
        $input = $request->all();
        $reader = Reader::createFromPath(public_path('uploads/sample.csv'), 'r');
        $all_rows = $reader->fetchAll();

        $mapped_columns = $input['columns'];

        $data = [];
        // dd($mapped_columns);

        foreach ($all_rows as $row) {
            $temp_data = [];
            foreach ($row as $index => $col) {
                if ($mapped_columns[$index] !== "0") {
                    $temp_data[$mapped_columns[$index]] = $col;
                }
            }
            $data[] = $temp_data;
            $temp_data = [];
        }
        dd($data);
    }

    public function locations()
    {
        $locations = StoreLocation::all();
        Mapper::map(53.381128999999990000, -1.470085000000040000, ['marker' => false]);
        foreach ($locations as $key => $location) {

            if($key == 0){
                Mapper::informationWindow($location['latitude'], $location['longitude'], $location['address'], ['open' => true, 'maxWidth'=> 300, 'markers' => ['title' => $location['address']]]);
            }else{
                Mapper::informationWindow($location['latitude'], $location['longitude'], $location['address'], ['open' => true, 'maxWidth'=> 300, 'markers' => ['title' => $location['address']]]);
            }
        }
        return view('site.mapLocations.index',compact('locations'));
    }

    public function myAccount()
    {
        $user = Client::where('id',Auth::guard('client')->id())->with('address')->first();
        return view('web.account.index',compact('user'));
    }

    public function submitAccountEdit(Request $request)
    {
        $data = $request->all();
        $user = Client::where('id',Auth::guard('client')->id())->first();
        $user->update($data);
        $address = $user->address;
        $address->update($data);
        Alert::success('Your data has been changed', 'Done!')->persistent('Close');
        return redirect()->back();
    }

    public function allMerchants()
    {
        $merchants = Merchant::where('parent_id',null)->get();
        return view('web.merchants.index',compact('merchants'));
    }

    public function getMerchantProduct($id)
    {
        $products = Product::where('merchant_id',$id)->with('images')->get();
        return view('web.merchants.view',compact('products'));
    }


}
