<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="\img\kemenag-logo.png" type="">

  <title> PPID KEMENAG </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="/css/cssuser/bootstrap.css" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="/css/cssuser/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="/css/cssuser/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="/css/cssuser/responsive.css" rel="stylesheet" />

</head>

<body>

  <div class="hero_area">
    <div class="bg-box">
      <img src="/img/imageuser/kemenag.png" alt="">
    </div>
    <!-- header section strats -->
    @include('user.layouts.header')
    <!-- end header section -->

    <!-- slider section -->
    @include('user.layouts.slider')
    <!-- end slider section -->
  </div>

  <!-- offer section -->

  <section class="offer_section layout_padding-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <img src="/img/imageuser/hutri.png" alt="Hutri Image" width="500px">
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <img src="/img/imageuser/pamflet.png" alt="Pamflet Image" width="450px">
                </div>
            </div>
        </div>
    </div>
</section>



  <!-- end offer section -->

  <!-- food section -->

  <section class="food_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Layanan PPID
        </h2>
      </div>

      {{-- <ul class="filters_menu">
        <li class="active" data-filter="*">All</li>
        <li data-filter=".burger">Agama</li>
        <li data-filter=".pizza">Pizza</li>
        <li data-filter=".pasta">Pasta</li>
        <li data-filter=".fries">Fries</li>
      </ul> --}}

      <div class="filters-content">
        <div class="row grid">
            @foreach ($dynamicTableCategories as $category => $tables)
            <div class="col-sm-6 col-lg-4 all pizza">
                <div class="box">
                    <div>
                        <div class="img-box">
                            <!-- Menggunakan gambar dari array cardImages -->
                            @if (array_key_exists($category, $categoryImages))
                                <img src="{{ $categoryImages[$category] }}" alt="{{ $category }}">
                            @else
                                <img src="img/imageuser/f1.png" alt="{{ $category }}">
                            @endif
                        </div>
                        <div class="detail-box">
                            <h5>
                                <b> Seksi {{ ucfirst($categoryNames[$category]) }}</b>
                            </h5>
                            <div class="options">
                              <ul>
                                  @foreach ($tables as $table)
                                  <li>
                                      {{-- Mengambil jumlah data dari tabel yang sesuai --}}
                                      @php
                                          $tableSlug = $table->slug;
                                          $tableCount = DB::table($tableSlug)->count();
                                      @endphp
                                      <h6>{{ $table->name }}: <b style="color: green">{{ $tableCount }} </b>data</h6>
                                  </li>
                                  @endforeach
                              </ul>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
    </div>
  </section>

  <!-- end food section -->
  @include('user.layouts.footer')
  <!-- footer section -->
  
  <!-- footer section -->

  <!-- jQery -->
  <script src="/js/jsuser/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script src="/js/jsuser/bootstrap.js"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- isotope js -->
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <!-- custom js -->
  <script src="/js/jsuser/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map -->

  <!-- Array Gambar -->
  <script>
    // Fungsi untuk menggulir halaman ke bagian atas
    function scrollUp() {
      window.scrollTo(0, 0); // Menggulir ke koordinat (0,0), yang merupakan bagian atas halaman
    }
  
    // Menggunakan event onbeforeunload untuk memanggil fungsi scrollUp saat halaman di-refresh
    window.onbeforeunload = scrollUp;
  </script>

</body>
</html>