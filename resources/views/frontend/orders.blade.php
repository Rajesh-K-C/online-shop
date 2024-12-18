@extends('layouts.base')

@section('title', "Order List")

@section('content')
<div class="container">
    <h1 class="h3 mb-4 text-gray-800">Order List</h1>
    <section>
    <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div style="display: flex; justify-content: space-between; align-items: center">
                    <h6 class="m-0 font-weight-bold text-primary">Your Orders</h6>
                </div>
            </div>
            <div class="card-body">
                @include('components.flash_message')
                <table class="table  table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Order ID</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data['orders'] as $order)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{ $order->id }}</td>
                            <td>Rs. {{ $order->grand_total }}</td>
                            <td>
                                @include('components/display_order_status_message', ['status' => $order->status])
                            </td>
                            <td>
                                <a href="{{route('order.show', $order->id)}}"
                                   class="btn btn-primary mr-1">View</a>
                            </td>
                        </tr>
                    @empty
                        <td colspan="5" class="text-center">Products not found!</td>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
<script>
    function getCity(e) {
        if (e.value !== "") {

        } else {
            city.innerHTML = `<option value="">Select City</option>`;
            console.log(city.parentNode);

        }
    }
</script>
@endsection