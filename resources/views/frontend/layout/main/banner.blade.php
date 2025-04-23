<!--============================
        BANNER PART 2 START
    ==============================-->
@php
    use App\Models\Banner;
    $banners = Banner::all();
@endphp
<section id="wsus__banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__banner_content">
                    <div class="row banner_slider">
                        @foreach ($banners as $banner)
                        <div class="col-xl-12 p-0">
                            <div class="wsus__single_slider position-relative text-center" style="height: 100vh; overflow: hidden;">
                                <img src="{{ asset('backend/assets/img/banners/' . $banner->img) }}"
                                     alt="Banner"
                                     style="width: 100%; height: 100vh; object-fit: cover;">
                        
                                <div class="wsus__single_slider_text position-absolute w-100 text-white text-center px-3"
                                     style="top: 50%; left: 0; transform: translateY(-50%); z-index: 2;">
                                    <h3>{{ $banner->top_text }}</h3>
                                    <h1>{{ $banner->middle_text }}</h1>
                                    <h6>{{ $banner->bottom_text }}</h6>
                                    
                                </div>
                            </div>
                        </div>
                        
                        @endforeach
                        
                        {{-- <div class="col-xl-12">
                            <div class="wsus__single_slider"
                                style="background: url('{{ asset('frontend/images/slider_2.jpg') }}');">
                                <div class="wsus__single_slider_text">
                                    <h3>new arrivals</h3>
                                    <h1>kid's fashion</h1>
                                    <h6>start at $49.00</h6>
                                    <a class="common_btn" href="#">shop now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="wsus__single_slider"
                                style="background: url('{{ asset('frontend/images/slider_3.jpg') }}');">
                                <div class="wsus__single_slider_text">
                                    <h3>new arrivals</h3>
                                    <h1>winter collection</h1>
                                    <h6>start at $99</h6>
                                    <a class="common_btn" href="#">shop now</a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--============================
        BANNER PART 2 END
    ==============================-->
