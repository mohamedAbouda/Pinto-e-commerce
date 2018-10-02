@if($order->status == 1)
<option value="1" selected>Submitted</option>
<option value="2">Confirmed</option>
<option value="3">Cancelled</option>
<option value="4">In Progress</option>
<option value="5">Processed</option>
<option value="6">Delivered</option>
<option value="7">Reviewed</option>
<option value="8">Dispute Not Delivered</option>
<option value="9">Dispute Wrong Order</option>
<option value="10">Dispute Bad Product</option>
<option value="11">Dispute Other</option>
@elseif($order->status == 2)
<option value="1">Submitted</option>
<option value="2" selected>Confirmed</option>
<option value="3">Cancelled</option>
<option value="4">In Progress</option>
<option value="5">Processed</option>
<option value="6">Delivered</option>
<option value="7">Reviewed</option>
<option value="8">Dispute Not Delivered</option>
<option value="9">Dispute Wrong Order</option>
<option value="10">Dispute Bad Product</option>
<option value="11">Dispute Other</option>
@elseif($order->status == 3)
<option value="1">Submitted</option>
<option value="2">Confirmed</option>
<option value="3" selected>Cancelled</option>
<option value="4">In Progress</option>
<option value="5">Processed</option>
<option value="6">Delivered</option>
<option value="7">Reviewed</option>
<option value="8">Dispute Not Delivered</option>
<option value="9">Dispute Wrong Order</option>
<option value="10">Dispute Bad Product</option>
<option value="11">Dispute Other</option>
@elseif($order->status == 4)
<option value="1">Submitted</option>
<option value="2">Confirmed</option>
<option value="3">Cancelled</option>
<option value="4" selected>In Progress</option>
<option value="5">Processed</option>
<option value="6">Delivered</option>
<option value="7">Reviewed</option>
<option value="8">Dispute Not Delivered</option>
<option value="9">Dispute Wrong Order</option>
<option value="10">Dispute Bad Product</option>
<option value="11">Dispute Other</option>
@elseif($order->status == 5)
<option value="1">Submitted</option>
<option value="2">Confirmed</option>
<option value="3">Cancelled</option>
<option value="4">In Progress</option>
<option value="5" selected>Processed</option>
<option value="6">Delivered</option>
<option value="7">Reviewed</option>
<option value="8">Dispute Not Delivered</option>
<option value="9">Dispute Wrong Order</option>
<option value="10">Dispute Bad Product</option>
<option value="11">Dispute Other</option>
@elseif($order->status == 6)
<option value="1">Submitted</option>
<option value="2">Confirmed</option>
<option value="3">Cancelled</option>
<option value="4">In Progress</option>
<option value="5">Processed</option>
<option value="6" selected>Delivered</option>
<option value="7">Reviewed</option>
<option value="8">Dispute Not Delivered</option>
<option value="9">Dispute Wrong Order</option>
<option value="10">Dispute Bad Product</option>
<option value="11">Dispute Other</option>
@elseif($order->status == 7)
<option value="1">Submitted</option>
<option value="2">Confirmed</option>
<option value="3">Cancelled</option>
<option value="4">In Progress</option>
<option value="5">Processed</option>
<option value="6">Delivered</option>
<option value="7" selected>Reviewed</option>
<option value="8">Dispute Not Delivered</option>
<option value="9">Dispute Wrong Order</option>
<option value="10">Dispute Bad Product</option>
<option value="11">Dispute Other</option>
@elseif($order->status == 8)
<option value="1">Submitted</option>
<option value="2">Confirmed</option>
<option value="3">Cancelled</option>
<option value="4">In Progress</option>
<option value="5">Processed</option>
<option value="6">Delivered</option>
<option value="7">Reviewed</option>
<option value="8" selected>Dispute Not Delivered</option>
<option value="9">Dispute Wrong Order</option>
<option value="10">Dispute Bad Product</option>
<option value="11">Dispute Other</option>
@elseif($order->status == 9)
<option value="1">Submitted</option>
<option value="2">Confirmed</option>
<option value="3">Cancelled</option>
<option value="4">In Progress</option>
<option value="5">Processed</option>
<option value="6">Delivered</option>
<option value="7">Reviewed</option>
<option value="8">Dispute Not Delivered</option>
<option value="9" selected>Dispute Wrong Order</option>
<option value="10">Dispute Bad Product</option>
<option value="11">Dispute Other</option>
@elseif($order->status == 10)
<option value="1">Submitted</option>
<option value="2">Confirmed</option>
<option value="3">Cancelled</option>
<option value="4">In Progress</option>
<option value="5">Processed</option>
<option value="6">Delivered</option>
<option value="7">Reviewed</option>
<option value="8">Dispute Not Delivered</option>
<option value="9">Dispute Wrong Order</option>
<option value="10" selected>Dispute Bad Product</option>
<option value="11">Dispute Other</option>
@elseif($order->status == 11)
<option value="1">Submitted</option>
<option value="2">Confirmed</option>
<option value="3">Cancelled</option>
<option value="4">In Progress</option>
<option value="5">Processed</option>
<option value="6">Delivered</option>
<option value="7">Reviewed</option>
<option value="8">Dispute Not Delivered</option>
<option value="9">Dispute Wrong Order</option>
<option value="10">Dispute Bad Product</option>
<option value="11" selected>Dispute Other</option>
@else
<option disabled selected>Select Status</option>
<option value="1">Submitted</option>
<option value="2">Confirmed</option>
<option value="3">Cancelled</option>
<option value="4">In Progress</option>
<option value="5">Processed</option>
<option value="6">Delivered</option>
<option value="7">Reviewed</option>
<option value="8">Dispute Not Delivered</option>
<option value="9">Dispute Wrong Order</option>
<option value="10">Dispute Bad Product</option>
<option value="11">Dispute Other</option>
@endif
