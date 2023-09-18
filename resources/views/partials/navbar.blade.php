{{-- <html>
    <head>
        <link rel="stylesheet" href="css/navbarstyle.css">
    </head>
    <body> --}}
        <nav class="navbar navbar-expand-lg navbar-dark bg-green" style="background: #003638"> <!-- Tambahkan kelas bg-green-dark -->
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <a href="/" class="navbar-brand">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('img/imageuser/lambang_kemenag.png') }}" alt="Logo Kemenag" width="200">
                        </div>
                    </a>
                    </ul>                    
                    
                    <ul class="navbar-nav ms-auto">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ auth()->user()->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="logout" method="post">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                        
                        <li class="nav-item">
                            <a href="/" class="nav-link se-auto">Kembali</a>
                        </li>

                        @endauth
                    </ul>
                    
                </div>
            </div>
        </nav>
        
    {{-- </body>
</html> --}}

