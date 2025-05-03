@extends('frontend.layout.main')

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <h3><i class="fas fa-box"></i> {{ $product->product }}  </h3>
                <div class="wsus__dashboard_wishlist">
                    <div class="row">
                        <div class="col-12">
                            <div class="wsus__cart_list wishlist">
                                <div class="table-responsive">
                                    <table>
                                        <tbody>

                                         @php
                                           $userCity= Auth::user()->cityRelation->city;
                                         @endphp  
                                            @foreach ($stocks as $stock)
                                            @php $coverAreas= explode(',', $stock->user->cover);@endphp  

                                                @if ($stock->price > 0 && $stock->stock > 0 && in_array($userCity,$coverAreas))
                                                    <div class="col-12">
                                                        <div class="wsus__offer_det_single">
                                                            <div
                                                                class="wsus__product_item d-flex align-items-center gap-3 p-2 border rounded-3 shadow-sm">

                                                                <img src="{{ asset('backend/assets/img/images/' . ($stock->user->image->image ?? 'No_Image.jpg')) }}"
                                                                    alt="product" class="img-fluid rounded-2"
                                                                    style="width: 120px; height: auto;" />


                                                                <div class="wsus__product_details overflow-hidden">

                                                                    <a class="wsus__pro_name d-block fw-bold text-primary"
                                                                        href="#"
                                                                        style="max-width: 100%; font-size: 18px;">
                                                                        {{ $stock->user->shop }}
                                                                    </a>

                                                                    @if ($stock->sale > 0)
                                                                        <p class="wsus__price text-success">
                                                                            {{ number_format($stock->price - $stock->sale, 2) }}
                                                                            <del
                                                                                class="text-muted">{{ number_format($stock->price, 2) }}</del>
                                                                        </p>
                                                                    @else
                                                                        <p class="wsus__price text-success">
                                                                            {{ number_format($stock->price, 2) }} </p>
                                                                    @endif
                                                                    <p class="wsus__pro_name d-block fw-bold text-danger"
                                                                        style="max-width: 100%;">
                                                                        {{ 'الحد الأدنى : ' . $stock->user->min_limit }}
                                                                    </p>
                                                                    <p class="wsus__pro_name d-block fw-bold text-success"
                                                                        style="max-width: 100%;">
                                                                        {{ 'نطاق التغطية  : ' . $stock->user->cover }}
                                                                    </p>
                                                                    <p class="wsus__pro_name d-block fw-bold text-truncate"
                                                                        style="max-width: 100%;">
                                                                        {{ 'أقصى كمية للشراء   : ' . $stock->max_limit }}
                                                                    </p>
                                                                </div>
                                                            </div>                                                          
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <!-- Pagination Links -->
                                    <div class="pagination">
                                        {{ $stocks->links() }}
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
