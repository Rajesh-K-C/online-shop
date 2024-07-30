@extends('layouts.backend_master')
@section('title', 'Edit Setting')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Setting Management</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Setting
                    <a href="{{route('backend.setting.create')}}" class="btn btn-primary ml-1">Create</a>
                    <a href="{{route('backend.setting.index')}}" class="btn btn-secondary ml-1">List</a>
                </h6>
            </div>
            <div class="card-body">
                @include('backend.components.flash_message')
                <form method="post" action="{{ route('backend.setting.update', $data['record']->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="setting_name">Setting Name*</label>
                        <input type="text" class="form-control" value="{{ $data['record']->setting_name }}" name="setting_name"
                               id="setting_name">
                        @include('backend.components.form_element_error', ['field'=> 'setting_name'])
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="website_name">Website Name*</label>
                        <input type="text" class="form-control" value="{{ $data['record']->website_name}}" name="website_name"
                               id="website_name">
                        @include('backend.components.form_element_error', ['field'=> 'website_name'])
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="logo_file">Logo</label>
                        <input type="file" name="logo_file" accept="image/jpg, image/jpeg, image/png, image/gif" id="logo_file" class="form-control" onchange="imagePreview(this, 'logo_file');">
                        <img {{$data['record']->logo?'':'style="display: none;"'}}src="{{asset('assets/images/setting/'. $data['record']->logo)}}" id="logo_file_preview" style="width: min(300px,100%)"  alt="">
                        @include('backend.components.form_element_error', ['field'=> 'logo_file'])
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="header_logo_file">Header Logo</label>
                        <input type="file" name="header_logo_file" accept="image/jpg, image/jpeg, image/png, image/gif" id="header_logo_file" class="form-control" onchange="imagePreview(this, 'header_logo_file');">
                        <img {{$data['record']->logo?'':'style="display: none;"'}}src="{{asset('assets/images/setting/'. $data['record']->logo)}}" id="header_logo_file_preview" style="width: min(300px,100%)"  alt="">
                        @include('backend.components.form_element_error', ['field'=> 'header_logo_file'])
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="footer_logo_file">Footer Logo</label>
                        <input type="file" class="form-control" name="footer_logo_file" id="footer_logo_file">
                        @include('backend.components.form_element_error', ['field'=> 'footer_logo_file'])
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="favicon_file">Favicon</label>
                        <input type="file" class="form-control" name="favicon_file" id="favicon_file">
                        @include('backend.components.form_element_error', ['field'=> 'favicon_file'])
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone">Phone</label>
                        <input type="text" class="form-control" value="{{ old('phone')}}" name="phone" id="phone">
                        @include('backend.components.form_element_error', ['field'=> 'phone'])
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone_optional">Phone Optional</label>
                        <input type="text" class="form-control" value="{{ old('phone_optional')}}" name="phone_optional"
                               id="phone_optional">
                        @include('backend.components.form_element_error', ['field'=> 'phone_optional'])
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" class="form-control" value="{{ old('email')}}" name="email" id="email">
                        @include('backend.components.form_element_error', ['field'=> 'email'])
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="address">Address</label>
                        <input type="text" class="form-control" value="{{ old('address')}}" name="address" id="address">
                        @include('backend.components.form_element_error', ['field'=> 'address'])
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="facebook_link">Facebook Link</label>
                        <input type="text" class="form-control" value="{{ old('facebook_link')}}" name="facebook_link"
                               id="facebook_link">
                        @include('backend.components.form_element_error', ['field'=> 'facebook_link'])
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="twitter_link">Twitter Link</label>
                        <input type="text" class="form-control" value="{{ old('twitter_link')}}" name="twitter_link"
                               id="twitter_link">
                        @include('backend.components.form_element_error', ['field'=> 'twitter_link'])
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="instagram_link">Instagram Link</label>
                        <input type="text" class="form-control" value="{{ old('instagram_link')}}" name="instagram_link"
                               id="instagram_link">
                        @include('backend.components.form_element_error', ['field'=> 'instagram_link'])
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="youtube_link">Youtube Link</label>
                        <input type="text" class="form-control" value="{{ old('youtube_link')}}" name="youtube_link"
                               id="youtube_link">
                        @include('backend.components.form_element_error', ['field'=> 'youtube_link'])
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="google_map_link">Google Map Link</label>
                        <input type="text" class="form-control" value="{{ old('google_map_link')}}"
                               name="google_map_link" id="google_map_link">
                        @include('backend.components.form_element_error', ['field'=> 'google_map_link'])
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="about_us">About Us</label>
                        <input type="text" class="form-control" value="{{ old('about_us')}}" name="about_us"
                               id="about_us">
                        @include('backend.components.form_element_error', ['field'=> 'about_us'])
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="opening_hours">Opening Hours</label>
                        <input type="text" class="form-control" value="{{ old('opening_hours')}}" name="opening_hours"
                               id="opening_hours">
                        @include('backend.components.form_element_error', ['field'=> 'opening_hours'])
                    </div>
                    <div class="form-group">
                        <span>Status* </span>
                        <input type="radio" name="status" id="activate" value="1">
                        <label class="form-label" for="activate">Activate</label>
                        <input type="radio" name="status" id="deactivate" value="0" checked>
                        <label class="form-label" for="deactivate">Deactivate</label>
                        @include('backend.components.form_element_error', ['field'=> 'status'])
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

@section('js')
    <script src="{{asset('assets/backend/js/imagePreview.js')}}"></script>
@endsection
