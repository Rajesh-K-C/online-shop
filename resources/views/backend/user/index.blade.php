@extends('layouts.backend_master')

@section('title', 'List User')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">User Management</h1>
        <form style="display: flex; justify-content: center; margin-bottom: 1rem">
            <div class="input-group" style="width: min(20rem, 100%)">
                <input type="text" class="form-control bg-light border-0 small"
                       placeholder="Search user..." aria-label="Search" name="query" style="outline: 1px solid rgba(0,0,0,0.26)"
                       aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div style="display: flex; justify-content: space-between; align-items: center">
                    <h6 class="m-0 font-weight-bold text-primary">List User</h6>
                    {{--                    <div>--}}
                    {{--                        <a href="{{route('backend.category.create')}}" class="btn btn-primary ml-1">Create</a>--}}
                    {{--                        <a href="{{route('backend.category.trash')}}" class="btn btn-success ml-1">Trash</a>--}}
                    {{--                    </div>--}}
                </div>
            </div>
            <div class="card-body">
                @include('components.flash_message')
                <table class="table  table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($users) == 0)
                        <tr>
                            <td colspan="5" class="text-center">Categories not found!</td>
                        </tr>
                    @endif
                    @foreach($users as $key=> $user)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @include('components/display_status_message', ['status' => $user->status])
                            </td>
                            <td style="display: flex">
                                <a href="{{route('backend.user.show', $user->id)}}"
                                   class="btn btn-primary mr-1">View</a>
                                @if($user->getRoleNames()[0] === 'admin')
                                    <button class="btn btn-success mr-1" disabled>Edit</button>
                                @else
                                    <a href="{{ route('backend.user.edit', $user->id) }}" class="btn btn-success mr-1">Edit</a>
                                @endif
                                {{--                        <form action="{{route('backend.user.destroy', $user->id)}}" method="post">--}}
                                {{--                            @csrf--}}
                                {{--                            --}}{{--                                        @method('DELETE')--}}
                                {{--                            <input type="hidden" name="_method" value="DELETE" />--}}
                                {{--                            <button type="submit" class="btn btn-danger">Delete</button>--}}
                                {{--                        </form>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
