@extends('layouts.backend_master')

@section('title', 'List City')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">City Management</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div style="display: flex; justify-content: space-between; align-items: center">
                    <h6 class="m-0 font-weight-bold text-primary">List City</h6>
                    <div>
                        <a href="{{route('backend.city.create')}}" class="btn btn-primary ml-1">Create</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('components.flash_message')
                <table class="table  table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>District</th>
                        <th>Name</th>
                        <th>Delivery Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data['records'] as $record)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{ $record->district->name }}</td>
                            <td>{{ $record->name }}</td>
                            <td>
                                @include('components/display_status_message', ['status' => $record->delivery_status])
                            </td>
                            <td>
                                <a href="{{route('backend.city.show', $record->id)}}"
                                   class="btn btn-primary mr-1">View</a>
                                <a href="{{ route('backend.city.edit', $record->id) }}"
                                   class="btn btn-warning mr-1">Edit</a>
                                <form style="display: inline-block"
                                      action="{{route('backend.city.destroy', $record->id)}}" method="post">
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
                        <td colspan="5" class="text-center">Cities not found!</td>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
