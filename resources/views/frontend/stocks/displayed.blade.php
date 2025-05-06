@extends('frontend.layout.main')

@section('sidebar_tabs')

        <li class="nav-item" role="presentation">
            <button class="nav-link " id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" role="tab"
                aria-controls="pills-home" aria-selected="true">الأقسام</button>
        </li>
   
@endsection
@section('categories_list')
    <div class="tab-pane fade " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="wsus__mobile_menu_main_menu">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <ul class="wsus_mobile_menu_category">
                    <li><a href="{{ request()->url() }}?cat_id=0"><i class="fal fa-gem"></i> عرض الكل </a></li>
                    @foreach ($categories as $category)
                        <li><a href="{{ request()->url() }}?cat_id={{ $category->id }}"><i class="fas fa-star"></i>
                                {{ $category->category }}</a></li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            @if (session('edit'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    {{ session('edit') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('delete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('delete') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="dashboard_content mt-2 mt-md-0">
                <h3><i class="fas fa-store"></i> البضاعة المعروضة </h3>
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
                                                            لا توجد بضاعة معروضة حاليًا.
                                                        </p>
                                                        <p class="text-secondary" style="font-size: 14px;">
                                                            سيتم عرض بضاعة جديدة قريبًا.
                                                        </p>
                                                    </div>
                                                </div>
                                            @else
                                                @foreach ($stocks as $stock)
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

                                                                    <p class="wsus__pro_name d-block fw-bold text-black"
                                                                        style="max-width: 100%;">
                                                                        {{ 'أقصى كمية : ' . $stock->max_limit }}
                                                                    </p>

                                                                    <div class="d-flex gap-2">

                                                                        <button type="button"
                                                                            class="btn btn-sm btn-outline-primary mt-1 shadow-sm"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#e{{ $stock->id }}">
                                                                            <i class="fas fa-edit"></i> تعديل
                                                                        </button>
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
                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="e{{ $stock->id }}"
                                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="exampleModalLabel">تعديل منتج
                                                                                    </h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <form method="POST"
                                                                                    action="{{ route('stocks.update', $stock->id) }}">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                    <div class="modal-body">

                                                                                        <div class="mb-3">
                                                                                            <label for="price"
                                                                                                class="form-label fw-bold">السعر:</label>
                                                                                            <input type="number"
                                                                                                name="price"
                                                                                                id="price"
                                                                                                value="{{ $stock->price }}"
                                                                                                class="form-control"
                                                                                                required>
                                                                                        </div>

                                                                                        <div class="mb-3">
                                                                                            <label for="sale"
                                                                                                class="form-label fw-bold">العرض:</label>
                                                                                            <input type="number"
                                                                                                name="sale"
                                                                                                id="sale"
                                                                                                value="{{ $stock->sale }}"
                                                                                                class="form-control">
                                                                                        </div>

                                                                                        <div class="mb-3">
                                                                                            <label for="stock"
                                                                                                class="form-label fw-bold">الكمية
                                                                                                المتاحة:</label>
                                                                                            <input type="number"
                                                                                                name="stock"
                                                                                                id="stock"
                                                                                                value="{{ $stock->stock }}"
                                                                                                class="form-control">
                                                                                        </div>

                                                                                        <div class="mb-3">
                                                                                            <label for="max_limit"
                                                                                                class="form-label fw-bold">الحد
                                                                                                الأقصى للشراء:</label>
                                                                                            <input type="number"
                                                                                                name="max_limit"
                                                                                                id="max_limit"
                                                                                                value="{{ $stock->max_limit }}"
                                                                                                class="form-control">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <a type="button"
                                                                                            class="btn btn-secondary"
                                                                                            data-bs-dismiss="modal">إغلاق</a>
                                                                                        <button type="submit"
                                                                                            class="btn btn-primary">تعديل
                                                                                        </button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="wsus__offer_progress mt-3">
                                                                <p><span>أقصى كمية للشراء : {{ $stock->max_limit }}</span>
                                                                    <span>المخزون :
                                                                        {{ $stock->stock }}</span>
                                                                </p>
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-success"
                                                                        role="progressbar"
                                                                        style="width: {{ ($stock->max_limit / $stock->stock) * 100 }}%;"
                                                                        aria-valuenow="{{ ($stock->max_limit / $stock->stock) * 100 }}"
                                                                        aria-valuemin="0" aria-valuemax="100">
                                                                        {{ number_format(($stock->max_limit / $stock->stock) * 100, 0) }}%
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
                                        {{ $stocks->appends(request()->query())->links() }}
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
