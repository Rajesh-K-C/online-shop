@extends('layouts.backend_master')
@section('title', 'User Detail')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">User Detail</h1>
    <div  class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    User Detail
                </div>
                <div class="card-body">
{{--                    @include('includes.flash_message')--}}
                    <table class="table  table-bordered table-responsive">
                        {{--                        <thead>--}}
                        {{--                        <tr>--}}
                        {{--                            <th>SN</th>--}}
                        {{--                            <th>Name</th>--}}
                        {{--                        </tr>--}}
                        {{--                        </thead>--}}
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{$user->id}}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>
                                {{$user->role_id}}
{{--                                @include('backend/category/check_category_status', ['status' => $category->status])--}}
                            </td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td>{{$user->phonenumber}}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{$user->address}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
