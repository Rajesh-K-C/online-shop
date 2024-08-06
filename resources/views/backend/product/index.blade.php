@extends('layouts.backend_master')

@section('title', 'List Product')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Product Management</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div style="display: flex; justify-content: space-between; align-items: center">
                    <h6 class="m-0 font-weight-bold text-primary">List Product</h6>
                    <div>
                        <a href="{{route('backend.product.create')}}" class="btn btn-primary ml-1">Create</a>
                        <a href="{{route('backend.product.trash')}}" class="btn btn-success ml-1">Trash</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('components.flash_message')
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
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{ $record->name }}</td>
                            <td>{{ $record->rank }}</td>
                            <td>
                                @include('components/display_status_message', ['status' => $record->status])
                            </td>
                            <td>
                                <a href="{{route('backend.product.show', $record->id)}}"
                                   class="btn btn-primary mr-1">View</a>
                                <a href="{{ route('backend.product.edit', $record->id) }}"
                                   class="btn btn-warning mr-1">Edit</a>
                                <form style="display: inline-block"
                                      action="{{route('backend.product.destroy', $record->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="_method" value="DELETE"/>
                                    <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <td colspan="5" class="text-center">Products not found!</td>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
