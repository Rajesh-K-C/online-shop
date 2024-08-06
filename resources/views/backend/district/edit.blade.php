@extends('layouts.backend_master')

@section('title', 'Edit State')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">State Management</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div style="display: flex; justify-content: space-between; align-items: center">
                    <h6 class="m-0 font-weight-bold text-primary">Edit State</h6>
                    <div>
                        <a href="{{route('backend.district.create')}}" class="btn btn-primary ml-1">Create</a>
                        <a href="{{route('backend.district.index')}}" class="btn btn-secondary ml-1">List</a>
                        <form style="display: inline-block"
                              action="{{route('backend.district.destroy', $data['record']->id)}}" method="post">
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
                <form method="post" action="{{ route('backend.district.update', $data['record']->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $data['record']->name}}"
                               placeholder="Enter name">
                        @include('components.form_element_error', ['field'=> 'name'])
                    </div>
                    <div class="form-group">
                        <label for="state" class="form-label">State</label>
                        <select type="text" name="state" id="state" class="form-control">
                            @foreach($data['states'] as $state)
                                <option value="{{$state->id}}" {{$state->id === $data['record']->state_id?"selected":""}} >{{$state->name}}</option>
                            @endforeach
                        </select>
                        @include('components.form_element_error', ['field'=> 'state'])
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
