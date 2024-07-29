@extends('layouts.backend_master')

@section('title', 'Category Details')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Category Management</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Category Details
                    <a href="{{route('backend.category.create')}}" class="btn btn-primary ml-1">Create</a>
                    <a href="{{route('backend.category.index')}}" class="btn btn-secondary ml-1">List</a>
                    <form  style="display: inline-block" action="{{route('backend.category.destroy', $data['record']->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="_method" value="DELETE" />
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </h6>
            </div>
            <div class="card-body">
                @include('backend.components.flash_message')
                <table class="table  table-bordered">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{$data['record']->id}}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{$data['record']->name}}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>
                            @if($data['record']->description)
                                {{$data['record']->description}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Rank</th>
                        <td>{{$data['record']->rank}}</td>
                    </tr>
                    <tr>
                        <th>Thumbnail</th>
                        <td>
                            @if($data['record']->thumbnail)
                                <img src="{{asset('assets/images/category/'.$data['record']->thumbnail)}}" style="width: min(300px,100%)" alt="Thumbnail">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>@include('backend.components.display_status_message', ['status'=> $data['record']->status])</td>
                    </tr>
                    <tr>
                        <th>Created By</th>
                        <td>{{$data['record']->createdBy->name}}</td>
                    </tr>
                    <tr>
                        <th>Updated By</th>
                        <td>
                            @if($data['record']->updated_by)
                                {{$data['record']->updatedBy->name}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{$data['record']->created_at}}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{$data['record']->updated_at}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
