@foreach($orders as $order)
<tr>
    <td>
        {{ $order->user ?  $order->user->name : '[deleted !]'}}
    </td>
    <td id="order{{$order->id}}" style="width: 320px;">
        @include('dashboardV2.orders.status')
    </td>
    <td>
        @if($order->dispute_comment || in_array($order->status, [8,9,10,11]))
        Yes , Read Dispute Comment <br>
        <strong>Or</strong> see the order status.
        @else
        No
        @endif
    </td>
    <td>
        <form action="{{route('dashboard.orders.changeOrderState')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="order_id" value="{{$order->id}}">
            <select class="form-control selectStatus" style="width: 200px" name="status">
                @include('dashboardV2.orders.changeStatus')
            </select>
        </form>
    </td>

    <td>
        <a href="{{url('dashboard/orders/'.$order->id)}}"
            class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top"
            title="Show"><i class="fa fa-eye"></i>
        </a>

        <a href="{{ route('dashboard.orders.disputeComments' ,$order->id) }}"
            class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top"
            title="Dispute comments"><i class="fa fa-reply"></i>
        </a>

        <a href="{{url('dashboard/orders/'.$order->id.'/edit')}}"
            class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top"
            title="Edit"><i class="fa fa-edit"></i>
        </a>
    </td>

</tr>
@endforeach
