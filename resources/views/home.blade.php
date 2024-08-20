@php
    if (Auth::user()->hasRole('user')) {
        header('Location: ' . route('dashboard'));
        exit();
    }
@endphp

@extends('layouts.backend_master')

@section('title', 'Admin Dashboard')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>

    </div>
    <!-- /.container-fluid -->

@endsection
