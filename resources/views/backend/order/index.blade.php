@extends('layouts.backend_master')

@section('title', 'List Order')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Order Management</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div style="display: flex; justify-content: space-between; align-items: center">
                <h6 class="m-0 font-weight-bold text-primary">List Order</h6>
            </div>
        </div>
        <div class="card-body">
            @include('components.flash_message')
            <table class="table  table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>User Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data['records'] as $record)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{ $record->user->name }}</td>
                            <td>{{ $record->grand_total }}</td>
                            <td>
                            @include('components/display_order_status_message', ['status' => $record->status])
                            </td>
                            <td style="display: flex; ">
                                <a href="{{route('backend.order.show', $record->id)}}"
                                    class="btn btn-primary mr-1">View</a>
                                <a href="{{ route('backend.order.edit', $record->id) }}"
                                    class="btn btn-warning mr-1">Update</a>
                                <form action="{{route('backend.order.destroy', $record->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
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