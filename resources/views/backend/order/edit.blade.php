@extends('layouts.backend_master')

@section('title', 'Edit Product')

@section('css')
<link rel="stylesheet" href="{{asset('assets/backend/css/custom-css.css')}}">
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Product Management</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div style="display: flex; justify-content: space-between; align-items: center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Product</h6>
                <div>
                    <a href="{{route('backend.order.index')}}" class="btn btn-secondary ml-1">List</a>

                </div>
            </div>
        </div>
        <div class="card-body">
            @include('components.flash_message')
            <form method="post" action="{{ route('backend.order.update', $order->id) }}">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <p class="form-label"><b>Order ID:</b> {{$order->id}} </p>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" {{$order->status === 1 ? "selected" : ""}}>Order</option>
                        <option value="2" {{$order->status === 2 ? "selected" : ""}}>Delivered</option>
                    </select>
                    @include('components.form_element_error', ['field' => 'category'])
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection

@section('js')
<script src="{{asset('assets/backend/js/imagePreview.js')}}"></script>
@endsection