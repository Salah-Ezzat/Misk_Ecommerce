@extends('frontend.layout.main')

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <h3><i class="fas fa-store"></i> البضاعة غير المعروضة </h3>
                <div class="wsus__dashboard_wishlist">
                    <div class="row">
                        <div class="col-12">
                            <div class="wsus__cart_list wishlist">
                                <div class="table-responsive">
                                    <table>
                                        <tbody>
                                            @foreach ($products as $product )
                                                    <div class="col-12">
                                                        <div class="wsus__offer_det_single">
                                                            <div
                                                                class="wsus__product_item d-flex align-items-center gap-3 p-2 border rounded-3 shadow-sm">

                                                                <img src="{{ asset('backend/assets/img/images/' . ($product?->firstImage?->image ?? 'No_Image.jpg')) }}"
                                                                    alt="product" class="img-fluid rounded-2"
                                                                    style="width: 120px; height: auto;" />


                                                                <div class="wsus__product_details overflow-hidden">

                                                                    <a class="wsus__pro_name d-block fw-bold text-primary"
                                                                        href="{{ route('stocks.comparePrices', $stock->product->id) }}"
                                                                        style="max-width: 100%; font-size: 18px;">
                                                                        {{ $product->product }}
                                                                    </a>

                                                                    <p class="wsus__pro_name d-block fw-bold text-truncate"
                                                                        style="max-width: 100%;">
                                                                        {{ $product->pack }}
                                                                    </p>

                                                                    <div class="d-flex gap-2">

                                                                        <a class="btn btn-sm btn-outline-primary mt-1 shadow-sm"
                                                                            href="#">
                                                                            <i class="fas fa-edit"></i> تعديل
                                                                        </a>
                                                                    </div>

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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
