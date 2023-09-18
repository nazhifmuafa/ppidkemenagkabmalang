@extends('admin.layouts.main')

@section('container')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tabel Layanan '{{ $table }}'</h1>
        <p class="mb-4">Ini adalah tabel yang berisi isi kolom dari layanan  yang telah dibuat, tabel ini hanya bisa dilihat oleh superadmin</p>

        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        

        <a href="{{ route('download.uploaded.template', $dynamicTable->slug) }}">
            <button type="button" class="btn btn-primary mb-3"><i class="fas fa-download"></i> Download Template</button>
        </a>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Admin</h6>
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="table_name">Nama Tabel:</label>
                        <input type="text" name="table_name" class="form-control" value="{{ $dynamicTable->slug }}" required >
                    </div>
                    <div class="form-group">
                        <label for="file">Pilih File Excel (.xlsx/.csv):</label>
                        <input type="file" name="file" class="form-control" accept=".xlsx,.csv" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Impor</button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <!-- Display the columns in the desired order -->
                                @foreach ($columns as $column)
                                    @if ($column !== 'id')
                                        <th>{{ $column }}</th>
                                    @endif
                                @endforeach
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                @foreach ($columns as $column)
                                    @if ($column !== 'id')
                                        <th>{{ $column }}</th>
                                    @endif
                                @endforeach
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <!-- Loop through the data and display it -->
                            @foreach ($data as $row)
                                <tr>
                                    @foreach ($columns as $column)
                                        @if ($column !== 'id')
                                            <td>{{ $row->$column }}</td>
                                        @endif
                                    @endforeach
                                    <td>
                                        <form action="{{ route('delete.data', ['table' => $dynamicTable->slug, 'id' => $row->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
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