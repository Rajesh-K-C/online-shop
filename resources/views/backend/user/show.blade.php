@extends('layouts.backend_master')
@section('title', 'User Details')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">User Management</h1>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center">
                            <h6 class="m-0 font-weight-bold text-primary">User Details</h6>
                            <div>
                                <a href="{{route('backend.user.index')}}" class="btn btn-secondary ml-1">List</a>
                            </div>
                        </div>
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
                                    {{$user->getRoleNames()[0]}}
                                    {{--                                @include('backend/category/check_category_status', ['status' => $category->status])--}}
                                </td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td>{{$user->phone}}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{$user->address}}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @include('components.display_status_message', ['status'=> $user->status])
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
