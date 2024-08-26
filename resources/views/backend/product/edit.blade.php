@extends('layouts.backend_master')

@section('title', 'Edit Product')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/backend/css/custom-css.css')}}">
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Product Management</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div style="display: flex; justify-content: space-between; align-items: center">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Product</h6>
                    <div>
                        <a href="{{route('backend.product.create')}}" class="btn btn-primary ml-1">Create</a>
                        <a href="{{route('backend.product.index')}}" class="btn btn-secondary ml-1">List</a>
                        <form style="display: inline-block"
                              action="{{route('backend.product.destroy', $data['record']->id)}}" method="post">
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
                <form method="post" action="{{ route('backend.product.update', $data['record']->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$data['record']->name }}"
                               placeholder="Enter name">
                        @include('components.form_element_error', ['field'=> 'name'])
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control"
                               placeholder="Enter slug" value="{{ $data['record']->slug }}">
                        @include('components.form_element_error', ['field'=> 'slug'])
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" name="price" id="price" class="form-control"
                               value="{{ $data['record']->price }}"
                               placeholder="Enter price">
                        @include('components.form_element_error', ['field'=> 'price'])
                    </div>
                    <div class="form-group">
                        <label for="discount_percentage">Discount Percentange</label>
                        <input type="text" name="discount_percentage" id="discount_percentage" class="form-control"
                               value="{{ $data['record']->discount_percentage }}"
                               placeholder="Enter discount percent">
                        @include('components.form_element_error', ['field'=> 'discount_percentage'])
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" name="stock" id="stock" class="form-control"
                               value="{{ $data['record']->stock }}"
                               placeholder="Enter stock">
                        @include('components.form_element_error', ['field'=> 'stock'])
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">Select Category</option>
                            @foreach($data['categories'] as $category)
                                <option value="{{$category->id}}" {{$data['record']->category_id === $category->id?"selected":""}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                        @include('components.form_element_error', ['field'=> 'category'])
                    </div>
                    <div class="form-group">
                        Status &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="status" value="1"
                               id="activate" {{$data['record']->status?"checked":""}}>
                        <label for="activate">Activate</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="status" value="0"
                               id="deactivate" {{!$data['record']->status?"checked":""}}>
                        <label for="deactivate">Deactivate</label>
                        @include('components.form_element_error', ['field'=> 'status'])
                        @include('components.form_element_error', ['field'=> 'status'])
                    </div>
                    <div class="form-group">
                        <label for="image_file" class="form-label">Image</label>
                        <input type="file" name="image_file" id="image_file" class="form-control"
                               onchange="imagePreview(this, 'image_file');">
                        <img src="{{asset('assets/images/product/'.$data['record']->image)}}"
                             class="image-preview preview-block" id="image_file_preview" alt="">
                        @include('components.form_element_error', ['field'=> 'image_file'])
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" name="description" id="description" class="form-control"
                                  placeholder="Enter description">{{ $data['record']->description }}</textarea>
                        @include('components.form_element_error', ['field'=> 'description'])
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

