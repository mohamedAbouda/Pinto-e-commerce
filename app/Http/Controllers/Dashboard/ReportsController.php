<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Order;
use App\Models\User;

class ReportsController extends BaseController
{
    public function index(Request $request)
    {
        $data['sales_per_month'] = $this->salesPerMonth($request->get('spmyear'));
        $data['users_per_month'] = $this->customersOverTime($request->get('uotyear',date('Y')));
        $data['users_per_year'] = $this->customersOverTime();
        $data['one_time_customers'] = $this->oneTimeCustomers();
        $data['returning_customers'] = $this->oneTimeCustomers(FALSE);
        $data['one_time_vs_returning_customers'] = $this->onTimeVsReturningCustomers($request->get('vsyear',date('Y')));
        $data['total_sales'] = Order::count();
        $data['total_payment'] = Order::sum('price');
        return view('dashboard.report.index',$data);
    }

    public function salesPerMonth($year = NULL)
    {
        if (!$year) {
            $year = date("Y");
        }
        $data = [];
        for ($i=1; $i <= 12; $i++) {
            $month = ($i<10) ? '0'.$i : $i;
            $count = Order::where('created_at' , 'LIKE' , "$year-$month%")->count();
            $data[] = [
                'month' => "$year-$month",
                'sales' => $count,
            ];
        }
        return json_encode($data);
    }

    public function customersOverTime($year = NULL)
    {
        $data = [];
        if (!$year) { //display per years
            $year = date('Y');
            foreach(range($year-10 , $year) as $y) {
                $count = User::where('created_at' , 'LIKE' , "$y%")->count();
                $data[] = [
                    'year' => "$y",
                    'customers' => $count,
                ];
            }
            // dd($data);
            return json_encode($data);
        }
        //display per months
        for ($i=1; $i <= 12; $i++) {
            $month = ($i<10) ? '0'.$i : $i;
            $count = User::where('created_at' , 'LIKE' , "$year-$month%")->count();
            $data[] = [
                'month' => "$year-$month",
                'customers' => $count,
            ];
        }
        return json_encode($data);
    }

    public function oneTimeCustomers($once = TRUE)
    {
        $orders_count_foreach_user = Order::select('*',DB::raw('COUNT(*) AS count'))
        ->groupBy('orders.user_id')->limit(10)
        ->get();

        if ($once) {
            return $orders_count_foreach_user->where('count' ,1); // return one time customers only
        }
        return $orders_count_foreach_user->where('count' , '>' ,1);
    }

    public function onTimeVsReturningCustomers($year = NULL) //sales
    {
        if (!$year) {
            $year = date("Y");
        }
        $data = [];

        $oneTimes = $this->oneTimeCustomers()->pluck('user_id')->toArray();
        $returnings = $this->oneTimeCustomers(FALSE)->pluck('user_id')->toArray();

        for ($i=1; $i <= 12; $i++) {
            $month = ($i<10) ? '0'.$i : $i;
            $one_time_customers_count = Order::whereIn('user_id' , $oneTimes)
            ->where('created_at' , 'LIKE' , "$year-$month%")->count();
            $returning_customers_count = Order::whereIn('user_id' , $returnings)
            ->where('created_at' , 'LIKE' , "$year-$month%")->count();

            $data[] = [
                'month' => "$year-$month",
                'one_time_customers_sales' => $one_time_customers_count,
                'returning_customers_sales' => $returning_customers_count,
            ];
        }
        return json_encode($data);
    }

    public function customersByCountries()
    {
        $countries=[];
        foreach (Country::all() as $country){
            $iso=$country['iso'];
            $countries[]=[
                'iso'=>$iso,
                'numberOfCustomers'=>User::whereHas('country',function ($q) use ($iso){
                    $q->where('iso',$iso);
                })->count(),
            ];
        }
        return $countries;
    }

}
