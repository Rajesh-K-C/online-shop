@extends('layouts.backend_master')

@section('title', 'Contact Messages')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Contact Messages</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div style="display: flex; justify-content: space-between; align-items: center">
                    <h6 class="m-0 font-weight-bold text-primary">Message</h6>
                </div>
            </div>
            <div class="card-body">
                @include('components.flash_message')
                <table class="table  table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data['records'] as $record)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{ $record->name?$record->name:$record->user->name }}</td>
                            <td>{{ $record->email?$record->email:$record->user->email }}</td>
                            <td>{{ $record->message }}</td>
                            <td>
{{--                                <a href="{{route('backend.product.show', $record->id)}}"--}}
{{--                                   class="btn btn-primary mr-1">View</a>--}}
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
