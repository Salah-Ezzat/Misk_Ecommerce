@extends('frontend.layout.main')

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <h3><i class="fas fa-store"></i> تجار الجملة </h3>
                <div class="wsus__dashboard_wishlist">
                    <div class="row">
                        <div class="col-12">
                            <div class="wsus__cart_list wishlist">
                                <div class="table-responsive">
                                    <table>
                                        <tbody>
                                            @if ($users->isEmpty())
                                                <div class="card text-center shadow-sm border-warning mt-4"
                                                    style="max-width: 500px; margin: auto;">
                                                    <div class="card-body">
                                                        <i class="fas fa-map-marked-alt fa-3x text-warning mb-3"></i>
                                                        <h5 class="card-title text-dark">عذرًا!</h5>
                                                        <p class="card-text text-muted">
                                                            لا يوجد تغطية لمنطقتك من تجارنا حاليًا.
                                                        </p>
                                                        <p class="text-secondary" style="font-size: 14px;">
                                                            نحن نعمل على التوسع لتغطية جميع المناطق قريبًا.
                                                        </p>
                                                    </div>
                                                </div>
                                            @else
                                                @foreach ($users as $user)
                                                    <div class="col-12">
                                                        <div class="wsus__offer_det_single">
                                                            <div
                                                                class="wsus__product_item d-flex align-items-center gap-3 p-2 border rounded-3 shadow-sm">

                                                                <img src="{{ asset('backend/assets/img/images/' . ($user->image->image ?? 'No_Image.jpg')) }}"
                                                                    alt="product" class="img-fluid rounded-2"
                                                                    style="width: 120px; height: auto;" />


                                                                <div class="wsus__product_details overflow-hidden">

                                                                    <a href="{{ route('stocks.show', $user->id) }}">
                                                                        <h5 class="mb-2 text-primary fw-bold"
                                                                            style="font-size: 18px;">
                                                                            <i class="fas fa-building"></i>
                                                                            {{ $user->shop }}
                                                                        </h5>
                                                                    </a>

                                                                    <p class="mb-1 text-dark">
                                                                        <strong>الحد الأدنى:</strong> {{ $user->min_limit }}
                                                                        جنيه
                                                                    </p>

                                                                    <p class="mb-1 text-primary-emphasis">
                                                                        <strong><i class="fas fa-map-marker-alt"></i>
                                                                            المحافظة:</strong> {{ $user->province }}
                                                                    </p>

                                                                    <p class="mb-0 text-success">
                                                                        <strong><i class="fas fa-route"></i> نطاق
                                                                            التغطية:</strong> {{ $user->cover }}
                                                                    </p>



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
                                        {{ $users->links() }}
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
