@extends('frontend.layout.main')

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content">
                <h3 class="mb-4 text-primary fw-bold">
                    <i class="fas fa-chart-bar"></i> إحصاءات العملاء
                </h3>

                <!-- نموذج التصفية -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light fw-semibold">تصفية النتائج</div>
                    <div class="card-body">
                        <form action="{{ route('evaluations.statistics') }}" method="GET">
                            <div class="row g-3">
                                <!-- اسم البائع -->
                                <div class="col-md-6 col-lg-4">
                                    <label for="seller" class="form-label">اسم البائع</label>
                                    <select class="form-select" name="seller_id" id="seller">
                                        <option value="0" selected>اختر البائع</option>
                                        @foreach ($sellers as $seller)
                                            <option value="{{ $seller->id }}">{{ $seller->shop }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- من تاريخ -->
                                <div class="col-md-6 col-lg-4">
                                    <label for="period" class="form-label">الفواتير من</label>
                                    <input type="date" class="form-control" id="period" name="from_date">
                                </div>

                                <!-- إلى تاريخ -->
                                <div class="col-md-6 col-lg-4">
                                    <label for="to" class="form-label">إلى</label>
                                    <input type="date" class="form-control" id="to" name="to_date">
                                </div>

                                <!-- زر البحث -->
                                <div class="col-12 text-center mt-3">
                                    <button type="submit" class="btn btn-primary px-5">
                                        <i class="fas fa-clipboard-check"></i> تقييم
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row g-4">
                    @if (isset($client))
                        <div class="card shadow-sm border-start border-3 border-info mb-4">
                            <div class="card-body">
                                <h5 class="mb-0 text-info fw-bold">
                                    👤 العميل: {{ $client->shop }}
                                </h5>
                            </div>
                        </div>
                    @endif

                    <!-- عدد الفواتير المطلوبة -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-primary shadow-sm border-primary">
                            <div class="card-body text-center">
                                <div class="fs-1">📄</div>
                                <h5 class="card-title mt-2">عدد الفواتير المطلوبة</h5>
                                <p class="card-text fs-4 fw-bold">{{ $allInvoices ?? 'غير محدد' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- عدد الفواتير المنفذة -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-success shadow-sm border-success">
                            <div class="card-body text-center">
                                <div class="fs-1">✅</div>
                                <h5 class="card-title mt-2">عدد الفواتير المنفذة</h5>
                                <p class="card-text fs-4 fw-bold">{{ $doneInvoices ?? 'غير محدد' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- عدد الفواتير المعلقة -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-warning shadow-sm border-warning">
                            <div class="card-body text-center">
                                <div class="fs-1">⏳</div>

                                <h5 class="card-title mt-2">عدد الفواتير المعلقة</h5>
                                <p class="card-text fs-4 fw-bold">{{ $suspendInvoices ?? 'غير محدد' }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- عدد الفواتير قيد التحضير -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-warning shadow-sm border-warning">
                            <div class="card-body text-center">
                                <div class="fs-1">🛠️</div>
                                <h5 class="card-title mt-2">عدد الفواتير قيد التحضير</h5>
                                <p class="card-text fs-4 fw-bold">{{ $preparedInvoices ?? 'غير محدد' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- عدد الفواتير الملغاة -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-danger shadow-sm border-danger">
                            <div class="card-body text-center">
                                <div class="fs-1">❌</div>
                                <h5 class="card-title mt-2">عدد الفواتير الملغاة</h5>
                                <p class="card-text fs-4 fw-bold">{{ $cancelledInvoices ?? 'غير محدد' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- قيمة الفواتير المطلوبة -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-info shadow-sm border-info">
                            <div class="card-body text-center">
                                <div class="fs-1">💰</div>
                                <h5 class="card-title mt-2">قيمة الفواتير المطلوبة</h5>
                                <p class="card-text fs-4 fw-bold">
                                    {{ number_format($invoicesValue ?? 0, 0) }} جنيه
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- قيمة الفواتير المنفذة -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-success shadow-sm border-success">
                            <div class="card-body text-center">
                                <div class="fs-1">💸</div>
                                <h5 class="card-title mt-2">قيمة الفواتير المنفذة</h5>
                                <p class="card-text fs-4 fw-bold">
                                    {{ number_format($doneValue ?? 0, 0) }} جنيه
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- فرق التنفيذ -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-danger shadow-sm border-danger">
                            <div class="card-body text-center">
                                <div class="fs-1">📉</div>
                                <h5 class="card-title mt-2">فرق التنفيذ</h5>
                                <p class="card-text fs-4 fw-bold">
                                    {{ number_format($differance ?? 0, 0) }} جنيه
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
