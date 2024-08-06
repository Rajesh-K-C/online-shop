@extends('layouts.backend_master')

@section('title', 'Create City')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">City Management</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div style="display: flex; justify-content: space-between; align-items: center">
                    <h6 class="m-0 font-weight-bold text-primary">Create City</h6>
                    <div>
                        <a href="{{route('backend.city.index')}}" class="btn btn-secondary ml-1">List</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('components.flash_message')
                <form method="post" action="{{ route('backend.city.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name')}}"
                               placeholder="Enter name">
                        @include('components.form_element_error', ['field'=> 'name'])
                    </div>
                    <div class="form-group">
                        <label for="district_id" class="form-label">District</label>
                        <select type="text" name="district_id" id="district_id" class="form-control">
                            <option value="">Select City</option>
                            @foreach($data['records'] as $record)
                                <option value="{{$record->id}}">{{$record->name}}</option>
                            @endforeach
                        </select>
                        @include('components.form_element_error', ['field'=> 'district_id'])
                    </div>
                    <div class="form-group">
                        <label for="delivery_charge" class="form-label">Delivery Charge</label>
                        <input type="number" min="0" name="delivery_charge" id="delivery_charge" class="form-control" value="{{ old('delivery_charge')}}" placeholder="Enter Delivery Charge">
                        @include('components.form_element_error', ['field'=> 'delivery_charge'])
                    </div>
                    <div class="form-group">
                        Delivery Status &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="delivery_status" value="1" id="activate">
                        <label for="activate">Activate</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="delivery_status" value="0" id="deactivate" checked>
                        <label for="deactivate">Deactivate</label>
                        @include('components.form_element_error', ['field'=> 'delivery_status'])
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
