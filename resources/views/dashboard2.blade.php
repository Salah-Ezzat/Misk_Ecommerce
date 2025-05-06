@extends('frontend.layout.main.master1')
@section('styles')
    <style>
        .hover-scale:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .animated-gradient {
            background: linear-gradient(-45deg, #4e73df, #1cc88a, #36b9cc, #f6c23e);
            background-size: 400% 400%;
            animation: gradientBG 8s ease infinite;
            color: white;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .hover-scale:hover {
            transform: scale(1.03);
        }
    </style>
@endsection

@section('content')
    @php
        use App\Models\Banner;
        $banners = Banner::all();
    @endphp
    <div class="row">
        <section id="wsus__banner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__banner_content">
                            <div class="row banner_slider">
                                @foreach ($banners as $banner)
                                    <div class="col-xl-12">
                                        <div class="wsus__single_slider"
                                            style="background: url({{ asset('backend/assets/img/banners/' . $banner->img) }});">
                                            <div class="wsus__single_slider_text">
                                                <h3>{{ $banner->top_text }}</h3>
                                                <h1>{{ $banner->middle_text }}</h1>
                                                <h6>{{ $banner->bottom_text }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--============================
                    BANNER PART 2 END
                ==============================-->



        <section id="wsus__monthly_top" class="py-5" style="background-color: #f8f9fa;">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-6">
                        <a href="{{ route('users.traders') }}" class="d-block text-decoration-none text-dark">
                            <div class="p-4 text-center bg-white rounded-4 shadow-lg h-100 hover-scale"
                                style="transition: all 0.3s;">
                                <img src="{{ asset('backend/assets/img/images/45ddae975241022049359419a423517b.png') }}"
                                    alt="تجار الجملة" class="img-fluid mb-3 rounded w-100"
                                    style="height: 550px; object-fit: cover;">
                                <h4 class="fw-bold mb-2">تجار جملةالجملة</h4>
                                <p class="text-muted">اعثر على أفضل الموردين لتجار جملة الجملة</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('users.wholesalers') }}" class="d-block text-decoration-none text-dark">
                            <div class="p-4 text-center bg-white rounded-4 shadow-lg h-100 hover-scale"
                                style="transition: all 0.3s;">
                                <img src="{{ asset('backend/assets/img/images/d7c88414d02e8c96ff6449fd51919f09.png') }}"
                                    alt="تجار الجملة" class="img-fluid mb-3 rounded w-100"
                                    style="height: 550px; object-fit: cover;">
                                <h4 class="fw-bold mb-2">تجار الجملة</h4>
                                <p class="text-muted">تصفح المنتجات والخدمات من تجار الجملة المعتمدين</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>


    </div>
@endsection
