@extends('superadmin.layouts.main')

@section('container')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tabel List Layanan</h1>
        <p class="mb-4">Ini adalah tabel yang berisi data-data Layanan, tabel ini hanya bisa dilihat oleh superadmin</p>

        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="/dashboard/services/create">
            <button type="button" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Layanan</button>
        </a>

        <!-- DataTales Example -->
        <div class="container">
            <div class="row">
                @foreach ($dynamicTableCategories as $category => $tables)
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                <h2>Seksi {{ ucfirst($category) }}</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($tables as $table)
                                        <div class="col-md-4 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <a href="/dashboard/services/{{ $table->slug }}">
                                                        <h5 class="card-title">{{ $table->name }}</h5>
                                                    </a>
                                                    <p class="card-text">Slug: {{ $table->slug }}</p>
                                                    <form action="{{ route('delete.table', $table->slug) }}" method="POST" id="delete-form-{{ $table->slug }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="showDeleteConfirmation('{{ $table->slug }}')">Delete Table</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
    </div>

    <script>
        function showDeleteConfirmation(slug) {
            if (confirm("Apakah Anda yakin ingin menghapus layanan ini?")) {
                document.getElementById('delete-form-' + slug).submit();
            }
        }
    </script>
    
@endsection