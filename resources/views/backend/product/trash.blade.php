@extends('layouts.backend_master')

@section('title', 'List Trash Product')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Product Management</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div style="display: flex; justify-content: space-between; align-items: center">
                    <h6 class="m-0 font-weight-bold text-primary">List Trash Product</h6>
                    <div>
                        <a href="{{route('backend.product.index')}}" class="btn btn-secondary ml-1">List</a>
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
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data['records'] as $record)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{ $record->name }}</td>
                            <td>{{ $record->price }}</td>
                            <td>
                                @include('components/display_status_message', ['status' => $record->status])
                            </td>
                            <td>
                                <a href="{{route('backend.product.restore', $record->id)}}"
                                   class="btn btn-warning mr-1">Restore</a>
                                <form style="display: inline-block"
                                      action="{{route('backend.product.remove', $record->id)}}" method="post">
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
                        <td colspan="5" class="text-center">Categories not found!</td>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
