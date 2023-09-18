@extends('superadmin.layouts.main')

@section('container')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="/dashboard/admins" class="btn btn-primary mr-2"><i class="fas fa-backward"></i> Kembali Melihat Semua Admin</a>
        </div>

        <div class="row justify-content-start">
            <div class="col-xl-4">
                <div class="card shadow mb-4 id-card">
                    <div class="card-header text-center py-4 bg-primary text-white">
                        <img src="https://ui-avatars.com/api/?name={{ $admin->name }}" class="img-fluid rounded-circle mb-3 id-card-img" alt="Profile Image">
                        <h3 class="mb-0">{{ $admin->name }}</h3>
                        <p class="mb-2">{{ $admin->username }}</p>
                    </div>
                    <div class="card-body text-center">
                        <p class="mb-1"><strong>ID:</strong> {{ $admin->id }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $admin->email }}</p>
                        <p class="mb-1"><strong>Password:</strong> {{ $admin->password }}</p>
                        <p class="mb-1"><strong>Created At:</strong> {{ $admin->created_at }}</p>
                        <p class="mb-1"><strong>Updated At:</strong> {{ $admin->updated_at }}</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="/dashboard/admins/{{ $admin->username }}/edit" class="btn btn-warning mr-2">Edit</i></a>

                        <form action="/dashboard/admins/{{ $admin->username }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger mr-2 border-0" onclick="return confirm('Apakah anda yakin menghapus ini?')">Delete</i></button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>        

    </div>
    <!-- End Begin Page Content -->

    
@endsection