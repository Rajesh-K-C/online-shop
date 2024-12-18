@extends('layouts.base')

@section('title', 'Order Detail | ')
@section('meta')
@endsection

@section('content')

<div class="container">
    @include('components.flash_message')
    <!-- Shoping Cart Section Begin -->
    <h1 class="h3 mb-4 text-gray-800">Order Detail</h1>

    <section>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div style="display: flex; justify-content: space-between; align-items: center">
                    <h6 class="m-0 font-weight-bold text-primary">Your Order detail</h6>
                </div>
            </div>
            <div class="card-body">
                <table class="table  table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Item ID</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price(Rs)</th>
                            <th>Total(Rs)</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data['order']->orderProducts as $item)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{ $item->id }}</td>
                                <td style="display: flex; gap:.5rem; align-items: center;">
                                    <img style="width: min(5rem, 100%); height: min(5rem, 100%);"
                                        src="{{asset('assets/images/product/' . $item->product->image)}}" alt="">
                                    <h5>{{ $item->product->name }}</h5>
                                </td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->quantity * $item->price }}</td>
                                <td>
                                    <a href="{{route('product', $item->product->slug)}}"
                                        class="btn btn-primary mr-1">View</a>
                                </td>
                            </tr>
                        @empty
                            <td colspan="7" class="text-center">Products not found!</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="p-4 shadow border mb-4">
            <p><b>Total:</b> Rs. {{$data['order']->grand_total}}</p>
            <p><b>Payment method:</b> eSewa </p>
            <p><b>Delivery address:</b> Kathmandu (Kirtipur), {{$data['order']->shipping_address}} </p>
            <p><b>Status:</b>
                @include('components/display_order_status_message', ['status' => $data['order']->status])
            </p>
        </div>
    </section>
</div>
@endsection


@section('js')
<script>

</script>
@endsection