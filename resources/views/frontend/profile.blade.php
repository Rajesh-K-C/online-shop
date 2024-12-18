@extends('layouts.base')

@section('title', "User Profile")

@section('content')
<div class="container">
    <h1 class="h3 mb-4 text-gray-800">User Profile</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div style="display: flex; justify-content: space-between; align-items: center">
                <h6 class="m-0 font-weight-bold text-primary">Your Profile</h6>
                <div>
                    {{-- <a href="{{route('backend.category.index')}}" class="btn btn-secondary ml-1">List</a>--}}
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('components.flash_message')
            <form method="post" action="{{ route('profile.update', Auth::user()->id) }}" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}"
                        placeholder="Enter your name" autocomplete="name">
                    @include('components.form_element_error', ['field' => 'name'])
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email"
                        value="{{ Auth::user()->email }}" autocomplete="email">
                    @include('components.form_element_error', ['field' => 'email'])
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter your phone"
                        value="{{ Auth::user()->phone }}" autocomplete="phone">
                    @include('components.form_element_error', ['field' => 'phone'])
                </div>
                {{--<div class="form-group">
                    <label for="state" style="margin-left: 1rem">State</label>
                    <select name="state" class="form-control" onchange="">
                        @if(!Auth::user()->address_id)
                        <option value="">Select State</option>
                        @foreach($data['states'] as $state)
                        <option value="{{$state->id}}">{{$state->name}}</option>
                        @endforeach
                        @else
                        @foreach($data['states'] as $state)
                        <option value="{{$state->id}}" {{$state->districts->cities->id ===
                            Auth::user()->address->city_id }}>{{$state->name}}</option>
                        @endforeach
                        @endif
                    </select>
                    @include('components.form_element_error', ['field' => 'state'])
                </div> --}}
                {{-- <div class="form-group">
                    <label for="district" style="margin-left: 1rem">District</label>
                    <select name="district" id="district" class="form-control" onchange="getCity(this);">
                        @if(!Auth::user()->address_id)
                        <option value="">Select District</option>
                        @foreach($data['districts'] as $district)
                        <option value="{{$district->id}}">{{$district->name}}</option>
                        @endforeach
                        @else
                        @foreach($data['states'] as $district)
                        <option value="{{$district->id}}" {{$district->cities->id === Auth::user()->address->city_id}}>
                            {{$district->name}}
                        </option>
                        @endforeach
                        @endif
                    </select>
                    @include('components.form_element_error', ['field' => 'district'])
                </div> --}}
                <div class="mb-3">
                    <label for="city" style="margin-left: 1rem" class="form-label">District and City</label>
                    <select name="city" id="city" class="form-select">
                        @if(!Auth::user()->address_id)
                            <option value="">Select District and City</option>
                            @foreach($data['cities'] as $city)
                                <option value="{{$city->id}}">
                                    {{$city->district->name}} ({{$city->name}})
                                </option>
                            @endforeach
                        @else
                            @foreach($data['cities'] as $city)
                                <option value="{{$city->id}}" {{$city->id === Auth::user()->address->city_id}}>
                                    {{$city->district->name}} ({{$city->name}})
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div>
                    @include('components.form_element_error', ['field' => 'city'])
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Enter your address"
                        autocomplete="address"
                        value="{{  Auth::user()->address_id ? Auth::user()->address->address : '' }}">
                    @include('components.form_element_error', ['field' => 'address'])</div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function getCity(e) {
        if (e.value !== "") {

        } else {
            city.innerHTML = `<option value="">Select City</option>`;
            console.log(city.parentNode);

        }
    }
</script>
@endsection