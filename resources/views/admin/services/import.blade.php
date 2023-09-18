
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Impor Data Excel</div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="table_name">Nama Tabel:</label>
                            <input type="text" name="table_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="file">Pilih File Excel (.xlsx/.csv):</label>
                            <input type="file" name="file" class="form-control" accept=".xlsx,.csv" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Impor</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

