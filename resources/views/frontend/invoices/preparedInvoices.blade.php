@extends('frontend.layout.main')

@section('content')

    <div class="row">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible text-center" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
        <div class="col-xl-9 col-xxl-10 col-lg-9  ms-auto">
            <div class="dashboard_content">
                <h3><i class="fas fa-hourglass-half"></i> الفواتير قيد التحضير</h3>
                <div class="wsus__dashboard_order">
                    <div class="table-responsive">
                        <table class="table">
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
                                            {{ number_format($invoice->invoice_total, 2) }} <span
                                                style="color: #28a745; font-weight: bold;">جنيه</span>
                                        </td>
                                        <td class="status"><a href="{{ route('invoices.edit', $invoice->id) }}">عرض
                                                الفاتورة</a></td>
                                        <td class="method">قيد التحضير</td>
                                        <td class="e_date"></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="py-5">
                                            <div class="alert alert-warning text-center d-flex flex-column align-items-center justify-content-center mb-0" role="alert" style="font-size: 1.1rem;">
                                                <i class="fas fa-info-circle fa-2x text-warning mb-2"></i>
                                                <span class="fw-bold">لا توجد فواتير قيد التحضير حاليًا.</span>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    setTimeout(function () {
        $(".alert").fadeOut("slow");
    }, 3000); // تختفي بعد 3 ثواني
</script> 
@endsection