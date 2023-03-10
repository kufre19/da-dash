@extends('layouts.custom.app')

@section('page_content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"> Admin Dashboard</h1>

        @if (Auth::user()->role == 'Admin')
            @include('admin.super_admin')
        @else
            @include('admin.staff_admin')
        @endif

    </div>
    <!-- /.container-fluid -->
@endsection
