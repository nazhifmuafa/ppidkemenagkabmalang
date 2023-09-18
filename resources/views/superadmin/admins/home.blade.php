@extends('superadmin.layouts.main')

@section('container')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tabel Admin</h1>
        <p class="mb-4">Ini adalah tabel yang berisi data-data Admin, tabel ini hanya bisa dilihat oleh superadmin</p>

        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="/dashboard/admins/create">
            <button type="button" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Admin</button>
        </a>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Admin</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($admins as $daftaradmin)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $daftaradmin->username }}</td>
                                <td>{{ $daftaradmin->name }}</td>
                                <td>{{ $daftaradmin->email }}</td>
                                <td>
                                    <a href="/dashboard/admins/{{ $daftaradmin->username }}" class="btn bg-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="/dashboard/admins/{{ $daftaradmin->username }}/edit" class="btn bg-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="/dashboard/admins/{{ $daftaradmin->username }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn bg-danger btn-sm border-0" onclick="return confirm('Apakah anda yakin menghapus ini?')"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    
@endsection