@extends('layouts.custom.app')

@section('page_content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Services</h1>

    </div>
    <!-- /.container-fluid -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
               
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>

                    <td>{{ $service->service }}</td>

                    <td>
                        <a href="{{ url('dashboard/service/edit/'.$service->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ url('dashboard/service/delete/'.$service->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $services->links() }}
@endsection
