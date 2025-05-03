@extends('backend.main')
@section('content')

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>الفواتير المعلقة</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">الرئيسية</a></div>
                    <div class="breadcrumb-item"><a href="#">الفواتير</a></div>
                    <div class="breadcrumb-item">الفواتير المعلقة</div>
                </div>
            </div>

            <div class="section-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session()->has('delete'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('delete') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session()->has('edit'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('edit') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <tr>
                                            <th class="package">رقم الفاتورة</th>
                                            <th class="tr_id"> المشتري</th>
                                            <th class="tr_id"> البائع</th>
                                            <th class="p_date">التاريخ</th>
                                            <th class="price">قيمة الفاتورة</th>
                                            <th class="e_date">عرض</th>
                                            <th class="status">التحكم </th>
                                            
                                        </tr>


                                        @forelse ($invoices as $invoice)
                                            <tr>
                                                <td class="package">
                                                    <a href="{{ route('invoices.show', $invoice->id) }}"
                                                        class="text-blue-600 font-bold underline hover:text-blue-800 transition duration-150">
                                                        {{ $invoice->id }}
                                                    </a>
                                                </td>
                                                <td class="tr_id">{{ $invoice->user->shop }}</td>
                                                <td class="tr_id">{{ $invoice->seller->shop }}</td>
                                                <td class="p_date">{{ $invoice->created_at->format('d - m - Y') }}</td>
                                                <td class="price">
                                                    {{ number_format($invoice->invoice_total, 2) }} <span
                                                        style="color: #28a745; font-weight: bold;">جنيه</span>
                                                </td>
                                                <td class="e_date"><a href="{{ route('invoices.show', $invoice->id) }}"
                                                    class="text-blue-600 font-bold underline hover:text-blue-800 transition duration-150">
                                                    عرض الفاتورة
                                                </a></td>

                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('invoices.confirm', $invoice->id) }}"
                                                            class="btn btn-primary">تأكيد</a>
                                                        <form action="{{ route('invoices.destroy', $invoice->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button class="btn btn-danger" type="submit">حذف</button>
                                                        </form>
                                                    </div>

                                                </td>
                                                <td class="e_date"></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="py-5">
                                                    <div class="alert alert-warning text-center d-flex flex-column align-items-center justify-content-center mb-0"
                                                        role="alert" style="font-size: 1.1rem;">
                                                        <i class="fas fa-info-circle fa-2x text-warning mb-2"></i>
                                                        <span class="fw-bold">لا توجد فواتير معلقة حاليًا.</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </table>
                                </div>
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
        </section>
    </div>
@endsection
