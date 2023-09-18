<!-- create.blade.php -->
@extends('superadmin.layouts.main')

@section('container')

<!-- Page Heading -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Edit {{ $admin->name }}</h1>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="{{ url()->previous() }}" class="btn btn-primary mr-2"><i class="fas fa-backward"></i> Kembali</a>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="/dashboard/admins/{{ $admin->username }}">
                            @method('put')
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Nama Admin</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $admin->name) }}" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $admin->username) }}" required>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class=" form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $admin->email) }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class=" form-group mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <div class="input-group"></div>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
 

<script>
    const nameInput = document.querySelector('#name');
    const usernameInput = document.querySelector('#username');

    let typingTimer;
    const doneTypingInterval = 300; // Set delay in milliseconds

    nameInput.addEventListener('input', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => {
            fetch('/dashboard/admins/checkUsername?name=' + encodeURIComponent(nameInput.value))
                .then(response => response.json())
                .then(data => {
                    usernameInput.value = data.username;
                });
        }, doneTypingInterval);
    });
</script>
@endsection
