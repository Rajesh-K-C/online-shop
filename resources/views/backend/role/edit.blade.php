@extends('layouts.backend_master')
@section('title', 'Edit Role')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Role Management</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div style="display: flex; justify-content: space-between; align-items: center">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Role </h6>
                    <div>
                        <a href="{{route('backend.role.create')}}" class="btn btn-primary ml-1">Create</a>
                        <a href="{{route('backend.role.index')}}" class="btn btn-secondary ml-1">List</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('components.flash_message')
                <form method="post" action="{{ route('backend.role.update', $data['record']->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="form-label" for="name">Role Name</label>
                        <input type="text" class="form-control" value="{{ $data['record']->name }}" {{ $data['record']->name === 'admin'?"readonly":"" }} name="name"
                               id="name">
                        @include('components.form_element_error', ['field'=> 'name'])
                    </div>

                    <div class="form-group">
                        <label>Select Permission</label>
                        <p>
                            @foreach($data['permissions'] as $permission)
                                <label for="p-{{ $permission->id }}" class="mr-2 my-0">
                                    <input type="checkbox" name="permission[]" value="{{ $permission->name }}"
                                           id="p-{{ $permission->id }}"
                                           @foreach($data['permissionIds']  as $id)
                                               @if($id === $permission->id)
                                                   checked
                                        @endif
                                        @endforeach
                                    >
                                    {{ $permission->name }}
                                </label>
                            @endforeach
                        </p>
                        @include('components.form_element_error', ['field'=> 'permission'])
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                        {{--                        <button type="reset" class="btn btn-danger">Reset</button>--}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{--    <script src="{{asset('assets/backend/js/imagePreview.js')}}"></script>--}}
@endsection
