@extends('layouts.backend_master')
@section('title', 'Create Setting')
@section('content')
    <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Create Setting</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Category</h6>
        </div>
        <div class="card-body">
            @include('backend.components.flash_message')
            <form method="post" action="{{route('backend.setting.store')}}">
                <div class="mb-3">
                    <label class="form-label">Setting Name</label>
                    <input type="text" class="form-control" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Website Name</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Slogan</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label class="form-label">Logo</label>
                    <input type="file" class="form-control" >
                </div>
                <div class="mb-3">
                    <label class="form-label">Favicon</label>
                    <input type="file" class="form-control" >
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" >
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" >
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" >
                </div>
                <div class="mb-3">
                    <label class="form-label">Facebook link</label>
                    <input type="text" class="form-control" >
                </div>
                <div class="mb-3">
                    <label class="form-label">Youtube link</label>
                    <input type="text" class="form-control" >
                </div>
                <div class="mb-3">
                    <label class="form-label">Instagram link</label>
                    <input type="text" class="form-control" >
                </div>
                <div class="mb-3">
                    <label class="form-label">Google Map link</label>
                    <input type="text" class="form-control" >
                </div>
                <div class="mb-3">
                    <label class="form-label">About Us</label>
                    <input type="text" class="form-control" >
                </div>
                <div class="mb-3">
                    <label class="form-label">Opening hours</label>
                    <input type="text" class="form-control" >
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    </div>
@endsection
