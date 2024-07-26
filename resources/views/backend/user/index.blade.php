@extends('layouts.backend_master')

@section('title', 'Admin Dashboard')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

{{--        <form class="form-inline mr-auto w-100 navbar-search" method="get" action="{{route('backend.user.search')}}">--}}
        <form class="form-inline mr-auto w-100 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small"
                       placeholder="Search for..." aria-label="Search" name="query"
                       aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
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
                        @include('backend/components/display_status_message', ['status' => $user->status])
                    </td>
                    <td style="display: flex">
                        <a href="{{route('backend.user.show', $user->id)}}" class="btn btn-primary mr-1">View</a>
{{--                        <a href="{{ route('backend.category.edit', $user->id) }}" class="btn btn-success mr-1">Edit</a>--}}
{{--                        <form action="{{route('backend.category.destroy', $user->id)}}" method="post">--}}
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
    <!-- /.container-fluid -->

@endsection
