@extends('layouts.backend_master')
@section('title', 'Create Role')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Role Management</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div style="display: flex; justify-content: space-between; align-items: center">
                    <h6 class="m-0 font-weight-bold text-primary">Create Role </h6>
                    <div>
                        <a href="{{route('backend.role.index')}}" class="btn btn-primary ml-1">List</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('components.flash_message')
                <form method="post" action="{{ route('backend.role.store') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="name">Role Name</label>
                        <input type="text" class="form-control" value="{{ old('name')}}" name="name"
                               id="name">
                        @include('components.form_element_error', ['field'=> 'name'])
                    </div>
                    <div class="form-group">
                        <label>Select Permission</label>
                        <p>
                            @foreach($data['records'] as $record)
                                <label for="p-{{$record->id}}" class="mr-2 my-0">
                                    <input type="checkbox" name="permission[]" value="{{$record->name}}"
                                           id="p-{{$record->id}}">
                                    {{$record->name}}
                                </label>
                            @endforeach
                        </p>
                        @include('components.form_element_error', ['field'=> 'permission'])
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
