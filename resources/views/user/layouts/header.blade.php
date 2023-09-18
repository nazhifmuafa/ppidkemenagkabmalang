<header class="header_section">
  <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light custom_nav-container">
          <a class="navbar-brand" href="index.html">
              <img src="/img/imageuser/lambang_kemenag.png" width="300" alt="logo kemenag">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                    <div class="user_option text-right">
                      @if(auth()->check() && auth()->user()->role === 'admin')
                        <p>Anda sudah login sebagai <a href="/login" class="order_online">Admin</a></p>
                      @elseif(auth()->check() && auth()->user()->role === 'superadmin')
                        <p>Anda sudah login sebagai 
                          <a href="/login" class="order_online">Superadmin</a>
                      </p>
                      @else
                        <a href="/login" class="order_online">
                          Admin
                        </a>
                      @endif
                    </div>
                  </li>
              </ul>
          </div>
      </nav>
  </div>
</header>
