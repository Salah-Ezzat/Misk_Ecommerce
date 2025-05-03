@extends('frontend.layout.main')

@section('content')
<?php session(['previous_previous_url' => url()->current()]); ?>
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <h3><i class="fas fa-user"></i> {{ $shop->shop }}</h3>
                <div class="wsus__dashboard_wishlist">
                    <div class="row">
                        <div class="col-12">
                            <div class="wsus__cart_list wishlist">
                                <div class="table-responsive">
                                    <table>
                                        <tbody>
                                            @if ($stocks->isEmpty())
                                                <div class="card text-center shadow-sm border-warning mt-4"
                                                    style="max-width: 500px; margin: auto;">
                                                    <div class="card-body">
                                                        <i class="fas fa-map-marked-alt fa-3x text-warning mb-3"></i>
                                                        <h5 class="card-title text-dark">عذرًا!</h5>
                                                        <p class="card-text text-muted">
                                                            لا توجد  بضاعة معروضة للتاجر حاليًا.
                                                        </p>
                                                        <p class="text-secondary" style="font-size: 14px;">
                                                            سيتم عرض بضاعة جديدة للتاجر قريبًا.
                                                        </p>
                                                    </div>
                                                </div>
                                            @else
                                            @foreach ($products as $product)
                                            @php
                                                $stock = $product->stocks->where('user_id', $userId)->first();
                                                $price = $stock->price - $stock->sale;
                                                $max_limit = $stock->max_limit;
                                                $min_limit = $stock->max_limit;
        
                                            @endphp
                                                    <div class="col-12">
                                                        <div class="wsus__offer_det_single">
                                                            <div
                                                                class="wsus__product_item d-flex align-items-center gap-3 p-2 border rounded-3 shadow-sm">

                                                                <img src="{{ asset('backend/assets/img/images/' . ($product->firstImage->image?? 'No_Image.jpg')) }}"

                                                                    alt="product" class="img-fluid rounded-2"
                                                                    style="width: 120px; height: auto;" />


                                                                <div class="wsus__product_details overflow-hidden">

                                                                    <a href="{{ route('stocks.comparePrices', $stock->product->id) }}">
                                                                        <h5 class="mb-2 text-primary fw-bold"
                                                                            style="font-size: 18px;">
                                                                        
                                                                            {{ $product->product }}
                                                                        </h5>
                                                                    </a>

                                                                    <p class="mb-1 text-dark">
                                                                        <strong>العبوة  :</strong> {{ $product->pack }}
                                                                        
                                                                    </p>

                                                                    <p class="mb-1 text-danger">
                                                                         @if ($stock->sale > 0)
                                                                        <p class="wsus__price text-success">
                                                                           
                                                                            {{ number_format($stock->price - $stock->sale, 2)}}
                                                                            <del
                                                                                class="text-muted">{{ number_format($stock->price, 2) }}</del>
                                                                        </p>
                                                                    @else
                                                                        <p class="wsus__price text-success">
                                                                         
                                                                            {{ number_format($stock->price, 2) }} </p>
                                                                    @endif
                                                                    </p>

                                                                    <p class="mb-0 text-success">
                                                                        <strong>الحد الأقصى للشراء
                                                                            :</strong> {{ $stock->max_limit }}
                                                                    </p>
                                                                    <a href="{{ route('orders.show', $userId) }}" class="btn btn-outline-primary mt-2 px-4">
                                                                        <i class="fas fa-shopping-cart"></i> طلب شراء
                                                                    </a>
                                                                    

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <!-- Pagination Links -->
                                    <div class="pagination">
                                        {{ $products->links() }}
                                    </div>
                                </nav>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
