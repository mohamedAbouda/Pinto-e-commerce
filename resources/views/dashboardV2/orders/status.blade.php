@if($order->status == 1)
Submitted
@elseif($order->status == 2)
Confirmed
@elseif($order->status == 3)
Cancelled
@elseif($order->status == 4)
In Progress
@elseif($order->status == 5)
Processed
@elseif($order->status == 6)
Delivered
@elseif($order->status == 7)
Reviewed
@elseif($order->status == 8)
Dispute Not Delivered
@elseif($order->status == 9)
Dispute Wrong Order
@elseif($order->status == 10)
Dispute Bad Product
@elseif($order->status == 11)
Dispute Other
@else
Undefiend Status
@endif
