@extends('layouts.main')

@php
    $navbarImage = 'kemenag-logo.png';
@endphp

@section('container')
    <div class="container login-container">
        <div class="grid">
            <form action="/ceklogin" method="post" class="form login">
                @csrf
                <header class="login__header">
                    <h3 class="login__title">Login</h3>
                </header>
                <div class="login__body">
                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="form__field">
                        <input type="email" name="email" class="@error('email') is-invalid @enderror" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                    </div>
                    <div class="form__field">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                </div>
                <footer class="login__footer">
                    <input type="submit" value="Login">
                </footer>
            </form>
        </div>
    </div>

@endsection
