@extends('layouts.dashboard')

@section('title','Payment Methods')

@section('path')
  <ol class="breadcrumb">
    <li>
      <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
      <a href="{{route('dashboard.payment_methods.index')}}">Payment Methods</a>
    </li>
    <li class="active">
      <strong>All</strong>
    </li>
  </ol>
@stop

@section('content')
  <section class="box ">

    <header class="panel_header">
      <h2 class="title pull-left">All Payment Methods</h2>
    </header>

    <div class="content-body">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">


          <!-- ********************************************** -->

          <table class="table table-hover" cellspacing="0" width="100%">
            <thead>
            <tr>
              <th>Payment Method</th>
              <th colspan="2">Availability</th>
            </tr>
            </thead>

            <tbody>
            @foreach($paymentMethods as $paymentMethod)
              <tr>
                <td>{{ $paymentMethod->name }}</td>
                @if($paymentMethod->name !== 'Cash on delivery')
                <td>
                    <a href="{{ route('dashboard.payment_methods.edit' , $paymentMethod->name) }}" class="btn btn-warning" target="_blank">
                        <i class="fa fa-edit"></i>
                    </a>
                </td>
                <td>
                @else
                <td colspan="2">
                @endif
                  <select class="form-control change-availability" data-methodid="{{$paymentMethod->id}}">
                      <option value="0" {{$paymentMethod->availability==0?' selected':''}}>Inactive</option>
                      <option value="1" {{$paymentMethod->availability==1?' selected':''}}>Active</option>
                  </select>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>

          <!-- ********************************************** -->


        </div>
        {{$paymentMethods->links()}}
      </div>
    </div>
  </section>
@stop
@section('scripts')
  <script>
    $(document).ready(function () {
      // Setup of AJAX
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      // change availability of payment method
      $('.change-availability').on('change', function () {
        // Data for Ajax
        var changeMethodAvailabilityUrl = '{{route('dashboard.payment_methods.availability')}}';
        var paymentMethodId = $(this).attr('data-methodid');
        var availability = $(this).val();
        // Send AJAX
        $.ajax({
          type: 'POST',
          url: changeMethodAvailabilityUrl,
          data: {
            'paymentMethodId': paymentMethodId,
            'availability': availability,
          },
          success: function (data) {
            console.log('Success w kda:');
            console.log(data);
          },
          error: function (data) {
            var errors = $.parseJSON(data.responseText);
            console.log(errors);
          }
        });
      });

    });
  </script>
@stop
