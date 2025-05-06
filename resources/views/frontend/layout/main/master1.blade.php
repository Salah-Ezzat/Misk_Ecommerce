@include('frontend.layout.main.head')
<body>
    <!--============================
      HEADER START
  ==============================-->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-2 col-md-1 d-lg-none">
                    @auth
                    <div class="wsus__mobile_menu_area">
                        <span class="wsus__mobile_menu_icon"><i class="fal fa-bars"></i></span>
                    </div>
                    @endauth
                  
                </div>
                <div class="col-xl-2 col-7 col-md-8 col-lg-2">
                    <div class="wsus_logo_area">
                        <a class="wsus__header_logo" href="index.html">
                            <img src="{{ asset('frontend/images/logo_2.png') }}" alt="logo" class="img-fluid w-100">
                        </a>
                    </div>
                </div>
            </div>
        </div>


    </header>
    <!--============================
      HEADER END
  ==============================-->


@include('frontend.layout.main.menu')

@auth
@include('frontend.layout.main.mobileMenu')   
@endauth




@yield('banner')


@yield('content')







@include('frontend.layout.main.footer')
