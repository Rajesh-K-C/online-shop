@extends('layouts.backend_master')

@section('title', 'List Category')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Category Management</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Category
                    <a href="{{route('backend.category.create')}}" class="btn btn-primary ml-1">Create</a>
                    <a href="{{route('backend.category.trash')}}" class="btn btn-secondary ml-1">Trash</a>
                </h6>
            </div>
            <div class="card-body">
                @include('backend.components.flash_message')
            <table class="table  table-bordered table-responsive">
                <thead>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Rank</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data['records'] as $record)
                    <td>{{$loop->index + 1}}</td>
                    <td>{{ $record->name }}</td>
                    <td>{{ $record->rank }}</td>
                    <td>
                        @include('backend/components/display_status_message', ['status' => $record->status])
                    </td>
                    <td>
                        <a href="{{route('backend.category.show', $record->id)}}" class="btn btn-primary mr-1">View</a>
                        <a href="{{ route('backend.category.edit', $record->id) }}" class="btn btn-success mr-1">Edit</a>
                        <form  style="display: inline-block" action="{{route('backend.category.destroy', $record->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="_method" value="DELETE" />
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                    </tr>
                @empty
                    <td colspan="5" class="text-center">Categories not found!</td>
                @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
