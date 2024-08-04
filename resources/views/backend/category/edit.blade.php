@extends('layouts.backend_master')

@section('title', 'Edit Category')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Category Management</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div style="display: flex; justify-content: space-between; align-items: center">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
                    <div>
                        <a href="{{route('backend.category.create')}}" class="btn btn-primary ml-1">Create</a>
                        <a href="{{route('backend.category.index')}}" class="btn btn-secondary ml-1">List</a>
                        <form style="display: inline-block"
                              action="{{route('backend.category.destroy', $data['record']->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="_method" value="DELETE"/>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('components.flash_message')
                <form method="post" action="{{ route('backend.category.update', $data['record']->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="form-label">Name*</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $data['record']->name}}"
                               placeholder="Enter name">
                        @include('components.form_element_error', ['field'=> 'name'])
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" name="description" id="description" class="form-control"
                                  placeholder="Enter description">{{ $data['record']->description}}</textarea>
                        @include('components.form_element_error', ['field'=> 'description'])
                    </div>
                    <div class="form-group">
                        <label for="rank">Rank*</label>
                        <input type="number" name="rank" id="rank" class="form-control"
                               value="{{ $data['record']->rank}}"
                               placeholder="Enter rank">
                        @include('components.form_element_error', ['field'=> 'rank'])
                    </div>
                    <div class="form-group">
                        <label for="image_file" class="form-label">Image</label>
                        <input type="file" name="image_file" accept="image/jpg, image/jpeg, image/png, image/gif"
                               id="image_file" class="form-control" onchange="imagePreview(this, 'image_file');"
                               placeholder="Enter image_file">
                        <img
                            {{$data['record']->image?'':'style="display: none;"'}}src="{{asset('assets/images/category/'. $data['record']->image)}}"
                            id="image_file_preview" style="width: min(300px,100%)" alt="">
                        @include('components.form_element_error', ['field'=> 'thumbnail'])
                    </div>
                    <div class="form-group">
                        Status* &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="status" value="1"
                               id="activate" {{$data['record']->status?"checked":""}}>
                        <label for="activate">Activate</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="status" value="0"
                               id="deactivate" {{!$data['record']->status?"checked":""}}>
                        <label for="deactivate">Deactivate</label>
                        @include('components.form_element_error', ['field'=> 'status'])
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update</button>
                        {{--                        <button type="reset" class="btn btn-danger">Reset</button>--}}
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
