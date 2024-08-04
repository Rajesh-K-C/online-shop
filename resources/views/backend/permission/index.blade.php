@extends('layouts.backend_master')

@section('title', 'Permission List')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Permission Management</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div style="display: flex; justify-content: space-between; align-items: center">
                    <h6 class="m-0 font-weight-bold text-primary">Permission List</h6>
                    <div>
                        <a href="{{route('backend.permission.create')}}" class="btn btn-primary ml-1">Create</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('components.flash_message')
                <table class="table  table-bordered">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        {{--                        <th>Status</th>--}}
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data['records'] as $record)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{ $record->name }}</td>
                            {{--                        <td>--}}
                            {{--                            @include('backend/components/display_status_message', ['status' => $record->status])--}}
                            {{--                        </td>--}}
                            <td>
                                {{--                                <a href="{{route('backend.permission.show', $record->id)}}"--}}
                                {{--                                   class="btn btn-primary mr-1">View</a>--}}
                                <a href="{{ route('backend.permission.edit', $record->id) }}"
                                   class="btn btn-success mr-1">Edit</a>
                                <form style="display: inline-block"
                                      action="{{route('backend.permission.destroy', $record->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="_method" value="DELETE"/>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <td colspan="5" class="text-center">Permissions not found!</td>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
