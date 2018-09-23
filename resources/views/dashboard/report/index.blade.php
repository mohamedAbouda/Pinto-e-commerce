@extends('layouts.dashboard')

@section('title','Reports')

@section('stylesheets')
  {{ Html::style('assets/dashboard/plugins/morris-chart/css/morris.css') }}
  <style>
    ul.nav-pills > li {
      margin: 0px;
    }

    ul.nav-pills > li > a {
      padding-left: 10%;
      cursor: pointer;
    }

    ul.nav-pills > li.active {
      background-color: #1fb5ac;
      color: white;
      border-style: solid;
      border-width: 0px;
      border-left-width: 4px;
      border-color: #9972b5;
    }

    ul.nav-pills > li > a:hover {
      background-color: #1fb5ac;
      color: white;
    }
  </style>

  <!-- jvectormap -->
  <link rel="stylesheet" href="{{url('assets/dashboard')}}/plugins/jquery-jvectormap-2.0.3/jquery-jvectormap-2.0.3.css"
        type="text/css" media="screen">
  {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.4/jquery-jvectormap.min.css"
        type="text/css" media="screen">--}}

@stop

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{ route('dashboard.index') }}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="#">Reports</a>
    </li>
    <li class="active">
      <strong>All</strong>
    </li>
  </ol>
@stop

@section('content')
  Reports
  <section class="box ">
    <header class="panel_header">
      <h2 class="title pull-left">Sales charts</h2>
    </header>

    <div class="content-body">
        <div class="row">
          <div class="col-md-4 col-sm-12 col-xs-12">
              <div class="r4_counter db_box">
                  <i class="pull-left fa fa-shopping-cart icon-md icon-rounded icon-orange"></i>
                  <div class="stats">
                      <h4>
                          <strong>
                              {{ $total_sales }}
                          </strong>
                      </h4>
                      <span>Total sales</span>
                  </div>
              </div>
          </div>
          <div class="col-md-4 col-sm-12 col-xs-12">
              <div class="r4_counter db_box">
                  <i class="pull-left fa fa-dollar icon-md icon-rounded icon-purple"></i>
                  <div class="stats">
                      <h4>
                          <strong>
                              ${{ $total_payment }}
                          </strong>
                      </h4>
                      <span>Total payments</span>
                  </div>
              </div>
          </div>
          <div class="col-md-4 col-sm-12 col-xs-12">
              <div class="r4_counter db_box">
                  <i class="pull-left fa fa-bar-chart icon-md icon-rounded icon-red"></i>
                  <div class="stats">
                      <h4>
                          <strong>
                              #{{ $visits }}
                          </strong>
                      </h4>
                      <span>Total visits</span>
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12" id="sales-per-month">
          <h3>
            Sales per month
          </h3>
          <div class="row">
            {{ Form::open(['url' => '#sales-per-month','method'=>'GET']) }}
            <div class="col-md-10">
              <select class="form-control" name="spmyear">
                  <?php $year = date('Y');?>
                @foreach(range($year,$year-10) as $index)
                  <option value="{{ $index }}" {{ request()->get('spmyear')==$index?'selected':'' }}>
                    {{ $index }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-primary">view</button>
            </div>
            {{ Form::close() }}
          </div>
          <div id="chart-container"></div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12" id="customers-over-time">
          <h3>
            Customers over time
          </h3>
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
              <a href="#customersPerMonth" role="tab" data-toggle="tab">
                Per month
              </a>
            </li>
            <li role="presentation">
              <a href="#customersPerYear" aria-controls="profile" role="tab" data-toggle="tab">
                Per year
              </a>
            </li>
          </ul>

          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="customersPerMonth">
              <div class="row">
                {{ Form::open(['url'=>'#customers-over-time','method'=>'GET']) }}
                <div class="col-md-10">
                  <select class="form-control" name="uotyear">
                      <?php $year = date('Y');?>
                    @foreach(range($year,$year-10) as $index)
                      <option value="{{ $index }}" {{ request()->get('uotyear')==$index?'selected':'' }}>
                        {{ $index }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary">view</button>
                </div>
                {{ Form::close() }}
              </div>
              <div id="customers-per-month-chart"></div>
            </div>
            <div role="tabpanel" class="tab-pane" id="customersPerYear">
              <div id="customers-per-year-chart"></div>
            </div>
          </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12" id="once-vs-returning-sales-per-month">
          <h3>
            Customers sales per month
          </h3>
          <div class="row">
            {{ Form::open(['url' => '#once-vs-returning-sales-per-month','method'=>'GET']) }}
            <div class="col-md-10">
              <select class="form-control" name="vsyear">
                  <?php $year = date('Y');?>
                @foreach(range($year,$year-10) as $index)
                  <option value="{{ $index }}" {{ request()->get('vsyear')==$index?'selected':'' }}>
                    {{ $index }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-primary">view</button>
            </div>
            {{ Form::close() }}
          </div>
          <div id="oncevsreturning-per-month-chart"></div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
          <h3>
            One time customers
          </h3>
          <div class="table-responsive">
            <table class="table">
              <thead>
              <tr>
                <th>#</th>
                <th>
                  Customer name
                </th>
                <th>
                  Email
                </th>
                <th>
                  Country
                </th>
                <th>
                  View
                </th>
              </tr>
              </thead>
              <tbody>
              @foreach($one_time_customers as $order)
                  <?php $customer = $order->customer;?>
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->country->name }}</td>
                    <td>
                      @if($customer)
                      <a href="{{ url('dashboard/customers/'.$customer->id.'/show') }}"
                         class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top"
                         title="Show">
                        <i class="fa fa-eye"></i>
                      </a>
                      @endif
                    </td>
                  </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
          <h3>
            Returning customers
          </h3>
          <div class="table-responsive">
            <table class="table">
              <thead>
              <tr>
                <th>#</th>
                <th>
                  Customer name
                </th>
                <th>
                  Email
                </th>
                <th>
                  Country
                </th>
                <th>
                  View
                </th>
              </tr>
              </thead>
              <tbody>
              @foreach($returning_customers as $order)
                  <?php $customer = $order->customer;?>
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->country->name }}</td>
                    <td>
                      @if($customer)
                      <a href="{{ url('dashboard/customers/'.$customer->id.'/show') }}"
                         class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top"
                         title="Show">
                        <i class="fa fa-eye"></i>
                      </a>
                      @endif
                    </td>
                  </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="box ">
    <header class="panel_header">
      <h2 class="title pull-left">Customers by country</h2>
      <div class="actions panel_actions pull-right">
        <i class="box_toggle fa fa-chevron-down"></i>
        <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
        <i class="box_close fa fa-times"></i>
      </div>
    </header>

    <div class="content-body">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">


          <!-- ********************************************** -->


          <div id="world-map" style="height:450px;width:100%"></div>


          <!-- ********************************************** -->


        </div>
      </div>
    </div>
  </section>


  <section class="box ">
    <header class="panel_header">
      <h2 class="title pull-left">Section 3</h2>
    </header>

    <div class="content-body">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">


          <!-- ********************************************** -->


          <!-- ********************************************** -->


        </div>
      </div>
    </div>
  </section>
@stop

@section('scripts')
  {{ Html::script('assets/dashboard/plugins/morris-chart/js/raphael-min.js') }}
  {{ Html::script('assets/dashboard/plugins/morris-chart/js/morris.min.js') }}
  <script type="text/javascript">
    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    //sales per month
    new Morris.Line({
      element: 'chart-container',
      data: <?=$sales_per_month;?>,
      xkey: 'month',
      ykeys: ['sales'],
      labels: ['Sales count'],
      xLabelFormat: function (x) {
        var month = months[x.getMonth()];
        return month;
      },
      dateFormat: function (x) {
        var month = months[new Date(x).getMonth()];
        return month;
      }
    });

    var customers_chart = [
      // customers per month
      new Morris.Line({
        element: 'customers-per-month-chart',
        data: <?=$users_per_month;?>,
        xkey: 'month',
        ykeys: ['customers'],
        labels: ['Customers count'],
        xLabelFormat: function (x) {
          var month = months[x.getMonth()];
          return month;
        },
        dateFormat: function (x) {
          var month = months[new Date(x).getMonth()];
          return month;
        }
      })
      // customers per year
      , new Morris.Line({
        element: 'customersPerYear',
        data: <?=$users_per_year;?>,
        xkey: 'year',
        ykeys: ['customers'],
        labels: ['Customers count']
      })
    ];

    new Morris.Line({
        element: 'oncevsreturning-per-month-chart',
        data: <?=$one_time_vs_returning_customers;?>,
        xkey: 'month',
        ykeys: ['one_time_customers_sales','returning_customers_sales'],
        labels: ['One-time customers sales' , 'Returning customers sales'],
        xLabelFormat: function (x) {
            var month = months[x.getMonth()];
            return month;
        },
        dateFormat: function (x) {
            var month = months[new Date(x).getMonth()];
            return month;
        }
    });

    $(document).ready(function () {
      $('ul.nav a').on('shown.bs.tab', function (e) {
        for (var i = 0; i < customers_chart.length; i++) {
          customers_chart[i].redraw();
        }
        $('svg').css({width: '100%'});
      });
    });
  </script>

  <!-- jvectormap -->
  {{--<script language="JavaScript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.4/jquery-jvectormap.min.js"></script>--}}
  <script src="{{url('assets/dashboard')}}/plugins/jquery-jvectormap-2.0.3/jquery-jvectormap-2.0.3.min.js"></script>
  {{--<script src="{{url('assets/dashboard')}}/plugins/jvectormap/jquery-jvectormap-2.0.1.min.js"></script>
  --}}
  {{--<script src="{{url('assets/dashboard')}}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>--}}
  <script src="{{url('assets/dashboard')}}/plugins/jquery-jvectormap-2.0.3/jquery-jvectormap-world-mill.js"></script>

  <!-- initialization of jvectormap -->
  <script>

    // Countries //
    var gdpData = {};
    $(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var urlCountries = '{{route('dashboard.reports.customers-by-countries')}}';
      $.ajax({
        type: 'POST',
        url: urlCountries,
        data: {},
        success: function (data) {
          console.log('Success w kda:');
          for (var i = 0; i < data.length; i++) {
            gdpData[data[i]['iso']] = data[i]['numberOfCustomers'];
          }
          console.log(gdpData);
        }
      });

    });


    // Initializing //
    $(function () {
      $('#world-map').vectorMap({

        map: 'world_mill',
        series: {
          regions: [{
            values: gdpData,
            scale: ['#C8EEFF', '#0071A4'],
            normalizeFunction: 'polynomial'
          }]
        },
        onRegionTipShow: function (e, el, code) {
          el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
        }

      });
    });
  </script>


@stop
