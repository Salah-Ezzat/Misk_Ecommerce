@include('frontend.layout.header')

@include('frontend.layout.navbar')

<!--=============================
    DASHBOARD START
  ==============================-->
@include('frontend.layout.sidebar')

 @yield('content')

 @include('frontend.layout.footer')