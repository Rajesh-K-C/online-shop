@extends('layouts.backend_master')
@section('title', 'Create Permission')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Permission Management</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div style="display: flex; justify-content: space-between; align-items: center">
                    <h6 class="m-0 font-weight-bold text-primary">Create Permission</h6>
                    <div>
                        <a href="{{route('backend.permission.index')}}" class="btn btn-primary ml-1">List</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('components.flash_message')
                <form method="post" action="{{ route('backend.permission.store') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="name">Setting Name</label>
                        <input type="text" class="form-control" value="{{ old('name')}}" name="name"
                               id="name">
                        @include('components.form_element_error', ['field'=> 'name'])
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
