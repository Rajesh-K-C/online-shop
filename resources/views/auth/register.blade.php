@extends('layouts.base')

@section('title', "Register")

@section('css')

<!-- Custom fonts for this template-->
<link href="{{asset('assets/backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="{{asset('assets/backend/css/sb-admin-2.min.css')}}" rel="stylesheet">

@endsection

@section('content')

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" value="{{ old('name') }}"
                                       name="name" id="name" autocomplete="name" autofocus
                                       placeholder="Name">
                                @include('components.form_element_error', ['field' => 'name'])
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="email"
                                       value="{{ old('email') }}" name="email"
                                       placeholder="Email Address" autocomplete="email">
                                @include('components.form_element_error', ['field' => 'email'])
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" name="password"
                                               id="password" placeholder="Password" autocomplete="new-password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                               name="password_confirmation" id="password_confirmation"
                                               placeholder="Confirm Password" autocomplete="new-password">
                                    </div>
                                </div>
                                @include('components.form_element_error', ['field' => 'password'])
                            </div>
                            <button class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                           
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection