@extends('layouts.backend_master')

@section('title', 'Product Details')

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
                    <h6 class="m-0 font-weight-bold text-primary">Product Details</h6>
                    <div>
                        <a href="{{route('backend.product.create')}}" class="btn btn-primary ml-1">Create</a>
                        <a href="{{route('backend.product.index')}}" class="btn btn-secondary ml-1">List</a>
                        <a href="{{ route('backend.product.edit', $data['record']->id) }}" class="btn btn-warning mr-1">Edit</a>
                        <form style="display: inline-block"
                              action="{{route('backend.product.destroy', $data['record']->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="_method" value="DELETE"/>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('components.flash_message')
                <table class="table  table-bordered">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{$data['record']->id}}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{$data['record']->name}}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{$data['record']->slug}}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>Rs. {{$data['record']->price}}</td>
                    </tr>
                    <tr>
                        <th>Discount Percent</th>
                        <td>{{$data['record']->discount_percentage}}%</td>
                    </tr>
                    <tr>
                        <th>Stock</th>
                        <td>{{$data['record']->stock}}</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>{{$data['record']->getCategory->name}}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>@include('components.display_status_message', ['status'=> $data['record']->status])</td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td>
                            <img src="{{asset('assets/images/product/'.$data['record']->image)}}"
                                 class="image-preview preview-block" alt="Image">
                        </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td> {{$data['record']->description}} </td>
                    </tr>
                    <tr>
                        <th>Created By</th>
                        <td>{{$data['record']->getCreatedBy->name}}</td>
                    </tr>
                    <tr>
                        <th>Updated By</th>
                        <td>
                            @if($data['record']->updated_by)
                                {{$data['record']->getUpdatedBy->name}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{$data['record']->created_at}}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{$data['record']->updated_at}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
