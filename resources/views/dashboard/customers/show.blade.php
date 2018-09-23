@extends('layouts.dashboard')

@section('title','Show a customer')

@section('path')
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
        <a href="{{route('dashboard.customers.index')}}">Customers</a>
    </li>
    <li class="active">
        <strong>Show</strong>
    </li>
</ol>
@stop

@section('content')
<section class="box ">

    <header class="panel_header">
        <h2 class="title pull-left">Show customer, {{$customer->name}}</h2>
        <div class="actions panel_actions pull-right"></div>
    </header>

    <div class="content-body">
        <div class="row">

            <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">

                <div class="form-group">
                    <label class="form-label" for="name">Customer Name</label>
                    <span class="desc"></span>
                    <div class="controls">
                        <input type="text" name="name" class="form-control" value="{{$customer['name']}}" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <span class="desc"></span>
                    <div class="controls">
                        <input type="email" name="email" class="form-control" value="{{$customer['email']}}" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="image">Image</label>
                    <span class="desc"></span>
                    @if($customer->image)
                    <div style="max-width: 100px; height: 100px;">
                        <img style="max-height: 100px;" src="{{ url('storage/app/'.$customer->image) }}">
                    </div>
                    @else
                    No image
                    @endif
                </div>

                <div class="form-group">
                    <label class="form-label" for="company">Company</label>
                    <span class="desc"></span>
                    <div class="controls">
                        <input type="text" name="company" class="form-control" value="{{$customer['company']}}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="company_url">Company's website link</label>
                    <span class="desc"></span>
                    <div class="controls">
                        <input type="text" name="company_url" class="form-control" value="{{$customer['company_url']}}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="company_email">Company's email</label>
                    <span class="desc"></span>
                    <div class="controls">
                        <input type="text" name="company_email" class="form-control" value="{{$customer['company_email']}}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="company_phone">Company's phone number</label>
                    <span class="desc"></span>
                    <div class="controls">
                        <input type="text" name="company_phone" class="form-control" value="{{$customer['company_phone']}}" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="country_id">Country</label>
                    <span class="desc"></span>
                    <div class="controls">
                        <input type="text" name="company" class="form-control" value="{{$customer->country->name}}" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="address">Address</label>
                    <span class="desc"></span>
                    <div class="controls">
                        <input type="text" name="address" class="form-control" value="{{$customer['address']}}" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="phone">Phone</label>
                    <span class="desc"></span>
                    <div class="controls">
                        <input type="text" name="phone" class="form-control" value="{{$customer['phone']}}" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="valid">Access state</label>
                    <span class="desc"></span>
                    <div class="controls">
                        <div class="input-group">
                            <input type="text" name="valid" class="form-control" value="{{ $customer['valid'] === 1 ? 'Access allowed' : 'Access not allowed' }}" disabled>
                            <span class="input-group-addon" style="padding:0px;border-top-width: 0px;border-bottom-width: 0px;">
                                {{ Form::open(['route' => ['dashboard.customers.access' , 'grant' , $customer->id]]) }}
                                <button class="btn btn-success" data-toggle="tooltip" data-placement="top"
                                title="Edit">
                                Grant
                            </button>
                            {{ Form::close() }}
                        </span>
                        <span class="input-group-addon" style="padding:0px;border-top-width: 0px;border-bottom-width: 0px;">
                            <button class="btn btn-danger customer-deny-btn" data-id="{{ $customer->id }}" data-toggle="modal" data-target="#customer-deny-modal">
                                Deny
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<section class="box ">
    <header class="panel_header">
        <h2 class="title pull-left">Orders</h2>
    </header>
    <div class="content-body">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>
                            Email
                        </th>
                        <th>
                            Address
                        </th>
                        <th>
                            Total price
                        </th>
                        <th>View more</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $offset = request()->get('page' , 1)*10 - 10;?>
                    @foreach($customer->orders as $order)
                    <tr>
                        <td>
                            {{ $offset + $loop->iteration }}
                        </td>
                        <td>
                            <a href="{{ route('dashboard.orders.show' , $order->id) }}">
                                {{ $order->id }}
                            </a>
                        </td>
                        <td>
                            {{ $order->email }}
                        </td>
                        <td>
                            {{ $order->address }}
                        </td>
                        <td>
                            {{ $order->price }}
                        </td>
                        <td>
                            <a href="{{ route('dashboard.orders.show' , $order->id) }}">
                                more
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $customer->orders->links() }}
    </div>
</section>

<div class="modal fade" id="customer-deny-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{ Form::open(['route' => ['dashboard.customers.access' , 'deny']]) }}
            <div class="modal-body">
                <label for="reason">Please specify denial message and reason</label>
                <textarea name="reason" rows="10" style="width:100%;"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.customer-deny-btn').click(function(e){
                e.preventDefault();
                var id = $(this).attr('data-id');
                var target = "{{ route('dashboard.customers.access' , 'deny') }}"
                $('#customer-deny-modal').find('form').attr('action' , target+'/'+id);
            });
        });
    </script>
@stop
