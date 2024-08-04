@extends('layouts.backend_master')

@section('title', 'Create Category')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Category Management</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div style="display: flex; justify-content: space-between; align-items: center">
                    <h6 class="m-0 font-weight-bold text-primary">Create Category</h6>
                    <div>
                        <a href="{{route('backend.category.index')}}" class="btn btn-secondary ml-1">List</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('components.flash_message')
                <form method="post" action="{{ route('backend.category.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">Name*</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name')}}"
                               placeholder="Enter name">
                        @include('components.form_element_error', ['field'=> 'name'])
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" name="description" id="description" class="form-control"
                                  placeholder="Enter description">{{ old('description')}}</textarea>
                        @include('components.form_element_error', ['field'=> 'description'])
                    </div>
                    <div class="form-group">
                        <label for="rank">Rank*</label>
                        <input type="number" name="rank" id="rank" class="form-control" value="{{ old('rank')}}"
                               placeholder="Enter rank">
                        @include('components.form_element_error', ['field'=> 'rank'])
                    </div>
                    <div class="form-group">
                        <label for="image_file" class="form-label">Image</label>
                        <input type="file" name="image_file" id="image_file" class="form-control"
                               onchange="imagePreview(this, 'image_file');">
                        <img src="#" style="display: none; width: min(300px,100%)" id="image_file_preview" alt="">
                        @include('components.form_element_error', ['field'=> 'image_file'])
                    </div>
                    <div class="form-group">
                        Status* &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="status" value="1" id="activate">
                        <label for="activate">Activate</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="status" value="0" id="deactivate" checked>
                        <label for="deactivate">Deactivate</label>
                        @include('components.form_element_error', ['field'=> 'status'])
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Create</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
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
