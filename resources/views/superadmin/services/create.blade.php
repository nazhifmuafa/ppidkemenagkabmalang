<!-- create.blade.php -->
@extends('superadmin.layouts.main')

@section('container')

<!-- Page Heading -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Create New Service</h1>
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="/dashboard/services">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Seksi</label>
                                <select id="kategori" class="form-control" name="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category }}">{{ ucfirst($category) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="tableName" class="form-label">Nama Tabel</label>
                                <input id="tableName" type="text" class="form-control @error('tableName') is-invalid @enderror" name="tableName" value="{{ old('tableName') }}" required autofocus>
                                @error('tableName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="slug" class="form-label">Nama Tabel di Database</label>
                                <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') }}" readonly>
                                @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3" id="columns_container">
                                <!-- Dynamic input fields for column names and types -->
                                <div class="row form-group" id="column_row_0">
                                    <div class="col-md-6">
                                        <label for="column_name">Nama Kolom</label>
                                        <input type="text" class="form-control" name="column_name[]" required pattern="[a-zA-Z0-9_]+">
                                        <small class="form-text text-muted">Only letters, numbers, and underscores are allowed.</small>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="column_type">Tipe Kolom</label>
                                        <select class="form-control" name="column_type[]">
                                            <option value="string">String</option>
                                            <option value="integer">Integer</option>
                                            <option value="text">Text</option>
                                            <option value="date">Date</option>
                                            <!-- Tambahkan tipe lain jika diperlukan -->
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="button_aksi">Aksi</label>
                                        <button type="button" class="btn btn-danger remove_column" data-column="0">Remove</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" id="add_column">Add Column</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
 

<script>
    var columnIndex = 1;

    document.getElementById('add_column').addEventListener('click', function() {
        var columnsContainer = document.getElementById('columns_container');
        var columnForm = document.createElement('div');
        columnForm.className = 'row form-group';
        columnForm.id = 'column_row_' + columnIndex;

        var columnNameInput = document.createElement('div');
        columnNameInput.className = 'col-md-6';
        columnNameInput.innerHTML = '<label for="column_name">Column Name</label>' +
                                    '<input type="text" class="form-control" name="column_name[]" required pattern="[a-zA-Z0-9_]+">' +
                                    '<small class="form-text text-muted">Only letters, numbers, and underscores are allowed.</small>';

        var columnTypeSelect = document.createElement('div');
        columnTypeSelect.className = 'col-md-4';
        columnTypeSelect.innerHTML = '<label for="column_type">Column Type</label>' +
                                    '<select class="form-control" name="column_type[]">' +
                                    '<option value="string">String</option>' +
                                    '<option value="integer">Integer</option>' +
                                    '<option value="text">Text</option>' +
                                    '<option value="date">Date</option>' +
                                    '</select>';

        var removeButton = document.createElement('div');
        removeButton.className = 'col-md-1';
        removeButton.innerHTML = '<label for="button_aksi">Aksi</label>' + '<button type="button" class="btn btn-danger remove_column" data-column="' + columnIndex + '">Remove</button>';

        columnForm.appendChild(columnNameInput);
        columnForm.appendChild(columnTypeSelect);
        columnForm.appendChild(removeButton);
        columnsContainer.appendChild(columnForm);

        columnIndex++;
    });

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove_column')) {
            var columnId = event.target.getAttribute('data-column');
            var columnRow = document.getElementById('column_row_' + columnId);
            columnRow.remove();
        }
    });

    // Update slug saat nama tabel berubah
    const tableNameInput = document.querySelector('#tableName');
    const slugInput = document.querySelector('#slug');
    
    tableNameInput.addEventListener('input', function() {
        const kategori = document.querySelector('#kategori').value;
        const tableName = this.value;
        const slug = kategori + '-' + tableName.replace(/[^a-zA-Z0-9]/g, '_');
        slugInput.value = slug.toLowerCase();
    });

</script>
@endsection
