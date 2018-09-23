<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDisputeComment;
use App\Models\OrderProduct;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\PaymentMethod;
use App\Models\Merchant;
use App\Mail\OrderStateChangedMail;
use Mail;
use Auth;
use App\Notifications\OrderStatusChange;

class OrderController extends BaseController
{

    protected $views_path ='dashboardV2.orders.';

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $input = $request->all();

        $filter_sql = Order::where('id','!=',NULL);

        if (isset($input['search'])) {
            $search = '%'.$input['search'].'%';
            $filter_sql = $filter_sql->whereHas('user',function($query) use($search) {
                $query->where('name','like',$search);
            });
        }

        if (isset($input['status'])) {
            $status = $input['status'];
            $filter_sql = $filter_sql->where('status',$status);
        }

        if (isset($input['merchant_id']) || Auth::guard('merchant')->check()) {
            if(Auth::guard('merchant')->check()){


                $MerchantId = Auth::guard('merchant')->user()->merchant_id;

            }
            $merchant_id = isset($input['merchant_id']) ? $input['merchant_id'] : $MerchantId;

            $ordersId = OrderProduct::whereHas('product', function ($query) use($merchant_id) {
                $query->where('merchant_id',$merchant_id);
            })->pluck('order_id')->toArray();
            // dd($merchant_id,$ordersId);
            $filter_sql = $filter_sql->whereIn('id',$ordersId);
        }

        if (isset($input['orderBy'])) {
            if ($input['orderBy'] === 'ASC') {
                $filter_sql = $filter_sql->orderBy('id','ASC');
            }else{
                $filter_sql = $filter_sql->orderBy('id','DESC');
            }
        }else {
            $filter_sql->orderBy('id','ASC');
        }
        // dd($filter_sql->toSql());
        $data = [];
        if (!$request->wantsJson()) {
            if(Auth::user()->getTable() != 'merchants'){
                $data['merchants'] = Merchant::where('id','!=',null)->pluck('name','id')->toArray();
                
                $data['orders'] = $filter_sql->paginate(20);

            }else{
                $ordersId = OrderProduct::whereHas('product', function ($query) use($MerchantId) {
                    $query->where('merchant_id',$MerchantId);
                })->pluck('order_id')->toArray();
                $data['orders'] = $filter_sql->whereIn('id',$ordersId)->paginate(20);
            }

            return view($this->views_path.'index',$data);
        }

        $data['orders'] = $filter_sql->paginate(20);

        return response()->json([
            'table' => view('dashboardV2.orders.parts.table',$data)->render(),
            'links' => view('dashboardV2.orders.parts.links',$data)->render()
        ]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view($this->views_path.'create' , $data);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(OrderStoreRequest $request)
    {
        $resource = Order::create($request->all());
        if ($resource) {
            return redirect()->back()->with('success' , "Order added successfully.");
        }
        return redirect()->back()->withErrors(["Something went wrong ! please try again."]);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $order = Order::where('id',$id)->with('items','user','address')->first();
        return view($this->views_path.'show' )->with(['order'=>$order]);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $order = Order::where('id',$id)->first();
        return view($this->views_path.'edit')->with(['order'=>$order]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $update = Order::where('id',$id)->first();
        $update->update($data);
        if ($update) {
            return redirect()->back()->with('success' , "Order edited successfully.");
        }
        return redirect()->back()->withErrors(["Something went wrong ! please try again."]);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Order $Order)
    {
        $Order->delete();
        return redirect()->back()->with('success', 'Order deleted.');
    }

    /**
    * =====================================================================
    */

    public function changeOrderState(Request $request , Order $order)
    {
        $order = Order::find($request->input('order_id'));
        $status = $request->input('status');

        $updateOrder = $order->update([
            'status' => $status,
        ]);

        $client = $order->user;
        try {
            if (in_array($status, [1,2,3,4,5,6,7]) ) {
                $client->notify(new OrderStatusChange($status));
            }
        } catch (\Exception $e) {
        }

        return $order = Order::where('id',$request->input('order_id'))->first();
    }

    public function historyOrders(Request $request)
    {
        $input = $request->all();

        $filter_sql = Order::where('id','!=',NULL);

        if (isset($input['search'])) {
            $search = '%'.$input['search'].'%';
            $filter_sql = $filter_sql->whereHas('user',function($query) use($search) {
                $query->where('name','like',$search);
            });
        }

        if (isset($input['status'])) {
            $status = $input['status'];
            $filter_sql = $filter_sql->where('status',$status);
        }

        if (isset($input['merchant_id'])) {
            $merchant_id = $input['merchant_id'];
            $ordersId = Item::whereHas('product', function ($query) use($merchant_id) {
                $query->where('merchant_id',$merchant_id);
            })->pluck('order_id')->toArray();
            if ($ordersId) {
                $filter_sql = $filter_sql->whereIn('id',$ordersId);
            }
        }

        if (isset($input['orderBy'])) {
            if ($input['orderBy'] === 'ASC') {
                $filter_sql = $filter_sql->orderBy('id','ASC');
            }else{
                $filter_sql = $filter_sql->orderBy('id','DESC');
            }
        }else {
            $filter_sql->orderBy('id','ASC');
        }

        $data = [];

        if (!$request->wantsJson()) {
            if(Auth::user()->getTable() != 'merchants'){
                $data['merchants'] = Merchant::pluck('name','id')->toArray();
                $data['orders'] = $filter_sql->whereIn('status',[3,5,6,7,8,9,10,11])->paginate(20);
            }else{
                $ordersId = Item::whereHas('product', function ($query) {
                    $query->where('merchant_id',Auth::id());
                })->pluck('order_id')->toArray();
                $data['orders'] = $filter_sql->whereIn('status',[3,5,6,7,8,9,10,11])->whereIn('id',$ordersId)->paginate(20);
            }
            return view($this->views_path.'index',$data);
        }

        $data['orders'] = $filter_sql->whereIn('status',[3,5,6,7,8,9,10,11])->paginate(20);

        return response()->json([
            'table' => view('dashboardV2.orders.parts.table',$data)->render(),
            'links' => view('dashboardV2.orders.parts.links',$data)->render()
        ]);
    }

    public function activeOrders(Request $request)
    {
        $input = $request->all();

        $filter_sql = Order::where('id','!=',NULL);

        if (isset($input['search'])) {
            $search = '%'.$input['search'].'%';
            $filter_sql = $filter_sql->whereHas('user',function($query) use($search) {
                $query->where('name','like',$search);
            });
        }

        if (isset($input['status'])) {
            $status = $input['status'];
            $filter_sql = $filter_sql->where('status',$status);
        }

        if (isset($input['merchant_id'])) {
            $merchant_id = $input['merchant_id'];
            $ordersId = Item::whereHas('product', function ($query) use($merchant_id) {
                $query->where('merchant_id',$merchant_id);
            })->pluck('order_id')->toArray();
            if ($ordersId) {
                $filter_sql = $filter_sql->whereIn('id',$ordersId);
            }
        }

        if (isset($input['orderBy'])) {
            if ($input['orderBy'] === 'ASC') {
                $filter_sql = $filter_sql->orderBy('id','ASC');
            }else{
                $filter_sql = $filter_sql->orderBy('id','DESC');
            }
        }else {
            $filter_sql->orderBy('id','ASC');
        }

        $data = [];

        if (!$request->wantsJson()) {
            if(Auth::user()->getTable() != 'merchants'){
                $data['merchants'] = Merchant::pluck('name','id')->toArray();
                $data['orders'] = $filter_sql->whereIn('status',[2,4])->paginate(20);
            }else{
                $ordersId = Item::whereHas('product', function ($query) {
                    $query->where('merchant_id',Auth::guard('merchant')->user()->merchant_id);
                })->pluck('order_id')->toArray();
                $data['orders'] = $filter_sql->whereIn('status',[2,4])->whereIn('id',$ordersId)->paginate(20);
            }
            return view($this->views_path.'index',$data);
        }

        $data['orders'] = $filter_sql->whereIn('status',[2,4])->paginate(20);

        return response()->json([
            'table' => view('dashboardV2.orders.parts.table',$data)->render(),
            'links' => view('dashboardV2.orders.parts.links',$data)->render()
        ]);
    }

    public function merchantHistoryOrders()
    {
       
        $ordersId = OrderProduct::whereHas('product', function ($query)  {
            $query->where('merchant_id',Auth::guard('merchant')->user()->merchant_id);
        })->pluck('order_id')->toArray();
        $data['orders'] = Order::whereIn('id',$ordersId)->whereIn('status',[3,5,6,7,8,9,10,11])->paginate(20);
        return view($this->views_path.'index',$data);
    }

    public function merchantActiveOrders($value='')
    {
       
        $ordersId = OrderProduct::whereHas('product', function ($query)  {
            $query->where('merchant_id',Auth::guard('merchant')->user()->merchant_id);
        })->pluck('order_id')->toArray();
        $data['orders'] = Order::whereIn('id',$ordersId)->whereIn('status',[2,4])->paginate(20);
        return view($this->views_path.'index',$data);
    }


    public function disputeComments(Order $order)
    {
        $merchant = auth('merchant')->user();

        $orders = OrderProduct::whereHas('product', function ($query) use($merchant) {
            $query->where('id' ,'<>' ,NULL);
            if ($merchant) {
                $query->where('merchant_id',$merchant->id);
            }
        })->groupBy('order_id')->where('order_id' ,$order->id)->exists();

        if (!$orders) {
            alert()->error('No products for this order & merchant or no dispute comments.', 'Error');
            return redirect()->back();
        }

        $data['comments'] = OrderDisputeComment::where('order_id' ,$order->id)->get();
        return view($this->views_path.'comments.index',$data);
    }

    public function disputeCommentReply(Request $request ,Order $order)
    {
        $input = $request->all();
        $merchant = auth('merchant')->user();
        $input['merchant_id'] = $merchant->id;
        $input['order_id'] = $order->id;
        OrderDisputeComment::create($input);
        alert()->success('Reply sent successfully.', 'Success');
        return redirect()->back();
    }
}
