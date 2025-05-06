@extends('frontend.layout.main')

@section('content')

    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9  ms-auto">
            <div class="dashboard_content">
                <h3><i class="fas fa-chart-line"></i> تقارير العملاء</h3>
                <div class="wsus__dashboard_order">
                    <div class="table-responsive">
                        <form class="container my-4 p-3 border rounded shadow-sm bg-light"
                            action="{{ route('evaluations.evaluation') }}" method="GET">

                            <div class="row g-3">
                                <!-- اسم البائع -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="seller" class="form-label">اسم البائع</label>
                                    <select class="form-select" name="seller_id" id="seller">
                                        <option selected value="0">اختر البائع</option>
                                        @foreach ($sellers as $seller)
                                            <option value="{{ $seller->id }}">{{ $seller->shop }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- اسم المشتري -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="buyer" class="form-label">اسم المشتري</label>
                                    <select class="form-select" name="user_id" id="buyer">
                                        <option selected value="0">اختر المشتري</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->shop }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- حالة الفاتورة -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="status" class="form-label">حالة الفاتورة</label>
                                    <select class="form-select" name="status" id="status">
                                        <option selected value="منفذة">منفذة</option>
                                        <option value="ملغاة">ملغاة</option>
                                        <option value="معلقة">معلقة</option>
                                        <option value="قيدالتحضير">قيد التحضير</option>
                                    </select>
                                </div>

                                <!-- من تاريخ -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="period" class="form-label">الفواتير من</label>
                                    <input type="date" class="form-control" id="period" name="from_date">
                                </div>

                                <!-- إلى تاريخ -->
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label for="to" class="form-label">إلى</label>
                                    <input type="date" class="form-control" id="to" name="to_date">
                                </div>

                                <!-- زر البحث -->
                                <div class="col-12 text-center mt-3">
                                    <button type="submit" class="btn btn-primary px-5">
                                        <i class="fas fa-search"></i> بحث
                                    </button>
                                </div>
                            </div>
                        </form>




                        {{-- <table class="table">
                            <thead>
                                <tr>
                                    <th class="package">رقم الفاتورة</th>
                                    <th class="tr_id"> المشتري</th>
                                    <th class="p_date">التاريخ</th>
                                    <th class="price">قيمة الفاتورة</th>
                                    <th class="status">الإطلاع</th>
                                    <th class="method">حالة الفاتورة</th>
                                    <th class="e_date">ملاحظات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($invoices as $invoice)
                                    <tr>
                                        <td class="package">
                                            <a href="{{ route('invoices.show', $invoice->id) }}"
                                               class="text-blue-600 font-bold underline hover:text-blue-800 transition duration-150">
                                              {{ $invoice->id }}
                                            </a>
                                        </td>
                                        <td class="tr_id">{{ $invoice->user->shop }}</td>
                                        <td class="p_date">{{ $invoice->created_at->format('d - m - Y') }}</td>
                                        <td class="price">
                                            {{ number_format($invoice->real_total, 2) }} <span
                                                style="color: #28a745; font-weight: bold;">جنيه</span>
                                        </td>
                                        <td class="status"><a href="{{ route('invoices.show', $invoice->id) }}">عرض الفاتورة</a></td>
                                        <td class="method">منفذة</td>
                                        <td class="e_date"></td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="py-5">
                                        <div class="alert alert-warning text-center d-flex flex-column align-items-center justify-content-center mb-0" role="alert" style="font-size: 1.1rem;">
                                            <i class="fas fa-info-circle fa-2x text-warning mb-2"></i>
                                            <span class="fw-bold">لا توجد فواتير منفذة حاليًا.</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                            
                        </table>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            <!-- Pagination Links -->
                            <div class="pagination">
                                {{ $invoices->links() }}
                            </div>
                        </nav>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
    @endsection
