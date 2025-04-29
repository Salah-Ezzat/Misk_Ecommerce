@extends('frontend.layout.main.master')

@section('styles')
    <style>
        .wsus__invoice_footer p {
            margin: 10px 0;
            /* إضافة مسافة بين الفقرات */
        }

        .wsus__invoice_footer .label {
            display: inline-block;
            /* عرض العنوان بجانب الـ input */
            width: 150px;
            /* عرض ثابت للعنوان */
            font-size: 14px;
            /* تقليل حجم الخط للعنوان */
        }

        .wsus__invoice_footer input.form-control {
            display: inline-block;
            /* عرض الـ input بجانب العنوان */
            width: 150px;
            /* عرض ثابت للـ input */
            font-size: 14px;
            /* تقليل حجم الخط داخل الـ input */
            padding: 8px;
            /* إضافة padding داخل الـ input */
        }
    </style>
@endsection

@section('content')

    <!--============================
                                                                                            INVOICE PAGE START
                                                                                        ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="wsus__invoice_area">
                <div class="wsus__invoice_header">
                    <div class="wsus__invoice_content">
                        <div class="row">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible text-center" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="col-12 mb-5">
                                <div class="wsus__invoice_single d-flex flex-column align-items-center">
                                    <h4> طلب شراء </h4>
                                    <h6> البائع : {{ $seller->shop }} </h6>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="wsus__invoice_description">
                        <div class="table-responsive">
                            <table class="table">



                                <tr>
                                    <th class="images">
                                        صورة المنتج
                                    </th>

                                    <th class="name">
                                        المنتج
                                    </th>

                                    <th class="amount">
                                        السعر
                                    </th>

                                    <th class="quentity">
                                        الكمية
                                    </th>
                                    <th class="total">
                                        الإجمالي
                                    </th>
                                </tr>
                                <form action="{{ route('carts.store') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="previous_url" id="previous_url">
                                    <input type="hidden" name="seller_id" value="{{ $seller->id }}">
                                    @foreach ($products as $product)
                                        @php
                                            $stock = $product->stocks->where('user_id', $userId)->first();
                                            $price = $stock->price;
                                            $max_limit = $stock->max_limit;
                                            $min_limit = $stock->max_limit;
                                            $Quantity = $quantity_assoc[$product->id];

                                        @endphp
                                        <input type="hidden" name="stock_ids[]" value="{{ $stock->id }}">
                                        <tr>
                                            <td class="images">
                                                <img src="{{ asset('backend/assets/img/images/' . ($product->firstImage->image ?? 'No_Image.jpg')) }}"
                                                    alt="product" class="img-fluid w-100">
                                            </td>

                                            <td class="name">
                                                <input type="hidden" name="product_ids[]" value="{{ $product->id }}">
                                                <p> {{ $product->product }}</p>
                                                <span>{{ $product->pack }}</span>
                                            </td>
                                            <td class="amount">
                                                <input type="hidden" name="prices[]" value="{{ $price }}">
                                                {{ $price }}
                                            </td>

                                            <td class="quentity">
                                                <div style="display: flex; align-items: center; gap: 5px;">
                                                    <button type="button"
                                                        class="btn btn-sm btn-light border quantity-decrease"
                                                        data-id="{{ $stock->id }}">-</button>

                                                    <input type="number" class="form-control text-center quantity-input"
                                                        value="{{ $Quantity ?? 0 }}" name="quantity[]" style="width: 60px;"
                                                        data-id="{{ $stock->id }}" data-price="{{ $price }}"
                                                        data-max="{{ $stock->max_limit }}"
                                                        data-original-quantity="{{ $Quantity ?? 0 }}" />



                                                    <button type="button"
                                                        class="btn btn-sm btn-light border quantity-increase"
                                                        data-id="{{ $stock->id }}">+</button>
                                                </div>
                                            </td>

                                            <td class="total" data-id="{{ $stock->id }}" data-total="0">
                                                {{ $price * $Quantity }}
                                            </td>
                                    @endforeach

                            </table>
                        </div>
                    </div>
                </div>
                <div class="wsus__invoice_footer">
                    <p>
                        <span class="label">الإجمالي :</span>
                        <input type="text" id="invoiceTotal" data-base="{{ $invoice_total }}" value="" readonly
                            class="form-control">
                    </p>
                    <p>
                        <span class="label">رسوم إضافية :</span>
                        <input type="number" id="extraFees" value="0.00" step="0.01" class="form-control">
                    </p>
                    <p>
                        <span class="label">خصم:</span>
                        <input type="number" id="discount" value="0.00" step="0.01" class="form-control">
                    </p>
                    <p>
                        <span class="label">إجمالي الفاتورة:</span>
                        <input type="text" id="finalTotal" name="invoice_total" value="" readonly
                            class="form-control">
                    </p>
                </div>



                <!-- أزرار -->
                <div class="text-center my-4">
                    <button type="submit" class="btn btn-success mx-2">
                        <i class="fas fa-paper-plane"></i> إرسال
                    </button>




                    <a href="#" type="button" id="rejectButton" class="btn btn-danger mx-2">
                        <i class="fas fa-times-circle"></i> رفض
                    </a>

                    </form>


                </div>
            </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.quantity-increase').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const input = document.querySelector(`input[data-id="${id}"]`);
                    const maxLimit = parseInt(input.dataset.max);

                    let currentValue = parseInt(input.value) || 0;
                    if (currentValue < maxLimit) {
                        input.value = currentValue + 1;
                        updateTotal(id);
                    } else {
                        alert('لقد وصلت للحد الأقصى للشراء لهذا المنتج.');
                    }
                });
            });

            document.querySelectorAll('.quantity-decrease').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const input = document.querySelector(`input[data-id="${id}"]`);

                    let currentValue = parseInt(input.value) || 0;
                    input.value = Math.max(currentValue - 1, 0);
                    updateTotal(id);
                });
            });

            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    let value = parseInt(this.value) || 0;
                    const maxLimit = parseInt(this.dataset.max);

                    if (value < 0) value = 0;
                    if (value > maxLimit) {
                        alert('لا يمكنك تجاوز الحد الأقصى المسموح.');
                        value = maxLimit;
                    }
                    this.value = value;
                    updateTotal(this.dataset.id);
                });
            });

            function updateTotal(id) {
                const input = document.querySelector(`input[data-id="${id}"]`);
                const quantity = parseInt(input.value) || 0;
                const price = parseFloat(input.dataset.price) || 0;
                const total = (quantity * price).toFixed(2);

                const totalCell = document.querySelector(`.total[data-id="${id}"]`);
                totalCell.textContent = total;
                totalCell.setAttribute('data-total', total);

                updateInvoiceTotal();
            }

            function updateInvoiceTotal() {
                // نبدأ من القيمة الأصلية المحفوظة في data-base
                const baseValue = parseFloat(document.getElementById('invoiceTotal')?.dataset.base) || 0;
                let dynamicSum = 0;

                document.querySelectorAll('.total').forEach(cell => {
                    const val = parseFloat(cell.getAttribute('data-total')) || 0;
                    dynamicSum += val;
                });

                // اجمع الأساسي مع المجموع الديناميكي
                const totalSum = baseValue + dynamicSum;

                const invoiceTotal = document.getElementById('invoiceTotal');
                if (invoiceTotal) {
                    invoiceTotal.value = totalSum.toFixed(2);
                }

                updateFinalTotal(totalSum);
            }




            function updateFinalTotal(subtotal) {
                const extra = parseFloat(document.getElementById('extraFees')?.value) || 0;
                const discount = parseFloat(document.getElementById('discount')?.value) || 0;
                const final = subtotal + extra - discount;

                if (document.getElementById('finalTotal')) {
                    document.getElementById('finalTotal').value = final.toFixed(2);
                }
            }




            // إضافة حدث عند تغيير الرسوم والخصم
            document.getElementById('extraFees').addEventListener('input', function() {
                updateFinalTotal(parseFloat(document.getElementById('invoiceTotal').value) || 0);
            });

            document.getElementById('discount').addEventListener('input', function() {
                updateFinalTotal(parseFloat(document.getElementById('invoiceTotal').value) || 0);
            });
            updateInvoiceTotal(); // ← تشغيل أولي لحساب الإجمالي
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rejectBtn = document.getElementById('rejectButton');

            const editBtn = document.getElementById('editButton');
            const causeContainer = document.getElementById('editCauseContainer');
            const causeSelect = document.getElementById('editCause');
            const form = document.getElementById('cartForm');

            const previousUrl = document.referrer;
            document.getElementById('previous_url').value = previousUrl;

            rejectBtn.addEventListener('click', function(e) {
                e.preventDefault(); // يمنع الانتقال التلقائي
                const confirmed = confirm("هل أنت متأكد أنك تريد رفض / حذف هذا الطلب؟");
                if (confirmed) {
                    // احصل على الصفحة السابقة من كائن document.referrer
                    const previousUrl = document.referrer;

                    // ضيفها على الرابط كـ باراميتر
                    const redirectUrl = this.href + '?previous=' + encodeURIComponent(previousUrl);

                    // يروح للرابط الجديد بعد التأكيد
                    window.location.href = redirectUrl;
                }
            });




        });
    </script>


    <script>
        setTimeout(function() {
            $(".alert").fadeOut("slow");
        }, 3000); // تختفي بعد 3 ثواني
    </script>
@endsection
