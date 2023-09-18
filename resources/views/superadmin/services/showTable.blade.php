@extends('superadmin.layouts.main')

@section('container')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tabel Layanan '{{ $service }}'</h1>
        <p class="mb-4">Ini adalah tabel yang berisi isi kolom dari layanan {{ $service }} yang telah dibuat, tabel ini hanya bisa dilihat oleh superadmin</p>

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


        <a href="/dashboard/services">
            <button type="button" class="btn btn-success mb-3"><i class="fas fa-backward"></i> Kembali</button>
        </a>

        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#uploadModal"><i class="fas fa-upload"></i> Unggah Template</button>
        <!-- Modal -->
        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Unggah File Excel Template</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/upload-excel-template" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="slug" value="{{ $dynamicTable->slug }}">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="excel_template">Pilih File Excel Template:</label>
                                <input type="file" class="form-control-file" name="excel_template" id="excel_template" accept=".xlsx">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Unggah</button>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
        

        <a href="{{ route('download.uploaded.template', $dynamicTable->slug) }}">
            <button type="button" class="btn btn-primary mb-3"><i class="fas fa-download"></i> Download Template</button>
        </a>
    
        <!-- Tambahkan ini sebelum tombol "Download Template" -->
        @if ($templateStatus)
            <p>Template sudah tersedia</p>
            <form action="{{ route('delete.template', ['slug' => $dynamicTable->slug]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger mb-3" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i> Hapus Template</button>
                <!-- Modal Konfirmasi Hapus Template -->
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Template</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus template ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <form action="{{ route('delete.template', ['slug' => $dynamicTable->slug]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        @else
            <p style="color: red">Template belum tersedia. Silakan unggah template terlebih dahulu.</p>
        @endif


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