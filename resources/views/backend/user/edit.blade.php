@extends('layouts.backend_master')

@section('title', 'Edit User')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">User Management</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div style="display: flex; justify-content: space-between; align-items: center">
                    <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
                    <div>
                        <a href="{{route('backend.user.index')}}" class="btn btn-secondary ml-1">List</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('components.flash_message')
                <form method="post" action="{{ route('backend.user.update', $data['record']->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <p><b> Name: </b>{{ $data['record']->name}}</p>
                    </div>
                    <div class="form-group">
                        <p><b> Email:</b> {{ $data['record']->email}}</p>
                    </div>
                    <div class="form-group">
                        <p><b>Phone Number:</b> {{ $data['record']->phone}}</p>
                    </div>
                    <div class="form-group">
                        <p><b>Address:</b> {{ $data['record']->address}}</p>
                    </div>
                    <div class="form-group">
                        <p>
                            <b>Image:</b>
                            @if($data['record']->image)
                                <img src="{{asset('assets/images/category/'. $data['record']->image)}}"
                                     style="width: min(300px,100%)" alt="">
                            @endif
                        </p>
                    </div>
                    <div class="form-group">
                        <b>Status:</b> &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="status" value="1"
                               id="activate" {{$data['record']->status?"checked":""}}>
                        <label for="activate">Activate</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="status" value="0"
                               id="deactivate" {{!$data['record']->status?"checked":""}}>
                        <label for="deactivate">Deactivate</label>
                        @include('components.form_element_error', ['field'=> 'status'])
                    </div>
                    <div class="form-group">
                        <label for="role"><b>Role:</b></label>
                        <select name="role" id="role" class="form-control">
                            @foreach($data['roles'] as $role)
                                <option value="{{$role->name}}" {{$role->name === $data['record']->getRoleNames()[0]?'selected':''}} >{{$role->name}}</option>
                            @endforeach
                        </select>
                        @include('components.form_element_error', ['field'=> 'role'])
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection

@section('js')
    <script src="{{asset('assets/backend/js/imagePreview.js')}}"></script>
@endsection
