@if($status == 1)
    <span class="text-primary">Order</span>
@elseif($status == 2)
    <span class="text-success">Delivered</span>
{{--
@elseif($status == 3)
    <span class="text-primary">OutForDelivery</span>
--}}
@else
    <span class="text-danger">Cancelled</span>
@endif