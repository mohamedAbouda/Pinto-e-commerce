@extends('layouts.dashboard')

@section('title','Customers')

@section('stylesheets')
<style>
    .table-responsive {
        width: 100%;
        overflow-y: hidden;
        overflow-x: auto;
        -ms-overflow-style:
        -ms-autohiding-scrollbar;
        -webkit-overflow-scrolling: touch;
    }
</style>
@stop

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.customers.index')}}">Customers</a>
    </li>
    <li class="active">
      <strong>All</strong>
    </li>
  </ol>
@stop

@section('content')
  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">All Customers</h2>
      <div class="actions panel_actions pull-right">
        <a href="{{route('dashboard.customers.create')}}" class="btn btn-primary">Create Customer</a>
      </div>
    </header>

    <div class="content-body">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-hover" cellspacing="0" width="100%">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Company Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th colspan="2">Access</th>
                    <th colspan="3">Action</th>
                  </tr>
                  </thead>

                  <tbody>
                  @foreach($customers as $customer)
                    <tr>
                      <td>{{$customer->id}}</td>
                      <td>{{$customer->name}}</td>
                      <td>{{ $customer->company }}</td>
                      <td>{{$customer->email}}</td>
                      <td>
                      @if($customer->country)
                      {{$customer->country->name}}
                      @else
                      No Country yet.
                      @endif
                      </td>
                      @if($customer->valid != 0)
                      <td colspan="2">
                          @if($customer->valid === -1)
                          <span class="text-danger">Rejected</span>
                          @else
                          <span class="text-success">Accepted</span>
                          @endif
                      </td>
                      @else
                      <td>
                          {{ Form::open(['route' => ['dashboard.customers.access' , 'grant' , $customer->id]]) }}
                          <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                              title="Edit">
                              Grant
                          </button>
                          {{ Form::close() }}
                      </td>
                      <td>
                          <button class="btn btn-sm btn-danger customer-deny-btn" data-id="{{ $customer->id }}" data-toggle="modal" data-target="#customer-deny-modal">
                              Deny
                          </button>
                      </td>
                      @endif
                      <td>
                          <a href="{{url('dashboard/customers/'.$customer->id.'/show')}}"
                              class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top"
                              title="Show">
                              <i class="fa fa-eye"></i>
                          </a>
                      </td>
                      <td>
                          <a href="{{url('dashboard/customers/'.$customer->id.'/edit')}}"
                              class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
                              title="Edit">
                              <i class="fa fa-edit"></i>
                          </a>
                      </td>
                      <td>
                          <a href="{{url('dashboard/customers/'.$customer->id.'/destroy')}}"
                              class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"
                              title="Delete">
                              <i class="fa fa-trash-o"></i>
                          </a>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
            </div>
        </div>
        {{$customers->links()}}
      </div>
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
