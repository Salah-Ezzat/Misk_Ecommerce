@extends('frontend.layout.main')

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <h3><i class="fas fa-store"></i> البضاعة المعروضة </h3>
                <div class="wsus__dashboard_wishlist">
                    <div class="row">
                        <div class="col-12">
                            <div class="wsus__cart_list wishlist">
                                <div class="table-responsive">
                                    <table>
                                        <tbody>


                                            @foreach ($stocks as $stock)
                                                @if ($stock->price > 0 && $stock->stock > 0)
                                                    <div class="col-12">
                                                        <div class="wsus__offer_det_single">
                                                            <div
                                                                class="wsus__product_item d-flex align-items-center gap-3 p-2 border rounded-3 shadow-sm">

                                                                <img src="{{ asset('backend/assets/img/images/' . ($stock->product?->firstImage?->image ?? 'No_Image.jpg')) }}"
                                                                    alt="product" class="img-fluid rounded-2"
                                                                    style="width: 120px; height: auto;" />


                                                                <div class="wsus__product_details overflow-hidden">

                                                                    <a class="wsus__pro_name d-block fw-bold text-primary"
                                                                        href="{{ route('stocks.comparePrices', $stock->product->id) }}"
                                                                        style="max-width: 100%; font-size: 18px;">
                                                                        {{ $stock->product->product }}
                                                                    </a>

                                                                    <p class="wsus__pro_name d-block fw-bold text-truncate"
                                                                        style="max-width: 100%;">
                                                                        {{ $stock->product->pack }}
                                                                    </p>

                                                                    @if ($stock->sale > 0)
                                                                        <p class="wsus__price text-success">
                                                                            {{ number_format($stock->price - $stock->sale, 2) }}
                                                                            <del
                                                                                class="text-muted">{{ number_format($stock->price, 2) }}</del>
                                                                        </p>
                                                                        <p class="wsus__pro_name d-block fw-bold text-truncate"
                                                                            style="max-width: 100%;">
                                                                            {{ 'العرض : ' . number_format($stock->sale, 2) }}
                                                                        </p>
                                                                    @else
                                                                        <p class="wsus__price text-success">
                                                                            {{ number_format($stock->price, 2) }} </p>
                                                                    @endif

                                                                    <div class="d-flex gap-2">

                                                                        <a class="btn btn-sm btn-outline-primary mt-1 shadow-sm"
                                                                            href="#">
                                                                            <i class="fas fa-edit"></i> تعديل
                                                                        </a>
                                                                        <form
                                                                            action="{{ route('stocks.destroy', $stock->id) }}"
                                                                            method="POST"
                                                                            onsubmit="return confirm('هل أنت متأكد من حذف {{ e($stock->product->product) }}؟')">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button
                                                                                class="btn btn-sm btn-outline-danger mt-1 shadow-sm"
                                                                                type="submit">
                                                                                <i class="fas fa-trash-alt"></i> حذف
                                                                            </button>
                                                                        </form>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="wsus__offer_progress mt-3">
                                                                <p><span>Sold 91</span> <span>المخزون :
                                                                        {{ $stock->stock }}</span></p>
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-success" role="progressbar"
                                                                        style="width: 65%;" aria-valuenow="65"
                                                                        aria-valuemin="0" aria-valuemax="100">65%</div>
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
