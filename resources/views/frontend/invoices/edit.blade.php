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
    <?php session(['previous_previous_url' => url()->current()]); ?>

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
                            <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                <div class="wsus__invoice_single">
                                    <h5>المشتري</h5>
                                    <h6>{{ $invoice->user->shop }}</h6>
                                    <p>تليفون :{{ $invoice->user->phone }}</p>
                                    <p>العنوان :{{ $invoice->user->address }}</p>
                                    <p>{{ $invoice->user->cityRelation->city . '-' . $invoice->user->province }}</p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                <div class="wsus__invoice_single text-md-center">
                                    <h5>رقم الفاتورة : {{ $invoice->id }}</h5>
                                    <h6>قيمة الفاتورة : {{ number_format($invoice->invoice_total, 2) }} <span
                                            style="color: #28a745; font-weight: bold;">جنيه</span></h6>
                                    <p>تنفيذ : {{ $invoice->real_total }}</p>

                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4">
                                <div class="wsus__invoice_single text-md-end">
                                    <h5>البائع</h5>
                                    <h6>{{ $invoice->seller->shop }}</h6>
                                    <p>تليفون :{{ $invoice->seller->phone }}</p>
                                    <p>العنوان :{{ $invoice->seller->address }}</p>
                                    <p>{{ $invoice->seller->cityRelation->city . '-' . $invoice->seller->province }}</p>
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
                                <form action="{{ route('carts.update.bulk') }}" method="POST"> 
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="previous_url" id="previous_url">
                                    @foreach ($carts as $cart)
                                        <input type="hidden" name="cart_ids[]" value="{{ $cart->id }}">
                                        <tr>
                                            <td class="images">
                                                <img src="{{ asset('backend/assets/img/images/' . ($cart->product && $cart->product->firstImage ? $cart->product->firstImage->image : 'NO_Image.jpg')) }}"
                                                alt="product" class="img-fluid w-100">
                                            </td>

                                            <td class="name">
                                                <p> {{ $cart->product->product }}</p>
                                                <span>{{ $cart->product->pack }}</span>
                                            </td>
                                            <td class="amount">
                                                {{ $cart->price }}
                                            </td>

                                            <td class="quentity">
                                                <div style="display: flex; align-items: center; gap: 5px;">
                                                    <button type="button"
                                                        class="btn btn-sm btn-light border quantity-decrease"
                                                        data-id="{{ $cart->id }}">-</button>

                                                    <input type="number" min="0" 
                                                        class="form-control text-center quantity-input"
                                                        value="{{ $cart->quantity }}" name="new_quantity[]"
                                                        style="width: 60px;" data-id="{{ $cart->id }}"
                                                        data-price="{{ $cart->price }}" />

                                                    <button type="button"
                                                        class="btn btn-sm btn-light border quantity-increase"
                                                        data-id="{{ $cart->id }}">+</button>
                                                </div>
                                            </td>

                                            <td class="total" data-id="{{ $cart->id }}"
                                                data-total="{{ $cart->price * $cart->quantity }}">
                                                {{ number_format($cart->price * $cart->quantity, 2) }}
                                            </td>
                                    @endforeach

                            </table>
                        </div>
                    </div>
                </div>
                <div class="wsus__invoice_footer">
                    <p>
                        <span class="label">الإجمالي :</span>
                        <input type="text" id="invoiceTotal" value="{{ number_format($invoice->invoice_total, 2) }}"
                            readonly class="form-control">
                    </p>
                    <p>
                        <span class="label">رسوم إضافية :</span>
                        <input type="number" id="extraFees" value="0.00" step="0.01"  class="form-control">
                    </p>
                    <p>
                        <span class="label">خصم:</span>
                        <input type="number" id="discount" value="0.00" step="0.01"  class="form-control">
                    </p>
                    <p>
                        <span class="label">إجمالي الفاتورة:</span>
                        <input type="text" id="finalTotal" name="new_total"
                            value="{{ $invoice->invoice_total}}" readonly class="form-control">
                    </p>
                </div>


                <!-- Select Input لاختيار السبب -->
                <div id="editCauseContainer" class="text-center my-3" >
                    <label for="editCause">في حالة التعديل :</label>
                    <select class="form-control mx-auto" id="editCause" name="edit_cause" style="max-width: 400px;">
                        <option value="">-- اختر السبب --</option>
                        <option value="1">عدم توفر المنتج وانتهاء الرصيد</option>
                        <option value="2">اختلاف السعر</option>
                        <option value="3">وجود مديونيات معلقة</option>
                        <option value="4">عدم مطابقة طلب الشراء للشروط</option>
                        <option value="5">أسباب أخرى</option>
                    </select>
                </div>

                <!-- أزرار -->
                <div class="text-center my-4">
                    <button type="submit" class="btn btn-success mx-2">
                        <i class="fas fa-paper-plane"></i> تنفيذ
                    </button>


                    </form>

                    <a href="{{ route('carts.delete', $invoice->id) }}" type="button" id="rejectButton"
                        class="btn btn-danger mx-2">
                        <i class="fas fa-times-circle"></i> رفض
                    </a>
                    <!-- زر العودة -->
                    <div class="mt-4">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> عودة
                        </a>
                    </div>



                </div>
            </div>
    </section>
    <!--============================
                         INVOICE PAGE END
                    ==============================-->
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.quantity-increase').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const input = document.querySelector(`input[data-id="${id}"]`);
                    input.value = parseInt(input.value) + 1;
                    updateTotal(id);
                });
            });

            document.querySelectorAll('.quantity-decrease').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const input = document.querySelector(`input[data-id="${id}"]`);
                    input.value = Math.max(parseInt(input.value) - 1, 0);
                    updateTotal(id);
                });
            });

            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    if (parseInt(this.value) < 0 || isNaN(this.value)) this.value = 0;
                    updateTotal(this.dataset.id);
                });
            });

            // تحديث المجموع الإجمالي عندما تتغير الكميات
            function updateTotal(id) {
                const input = document.querySelector(`input[data-id="${id}"]`);
                const quantity = parseInt(input.value);
                const price = parseFloat(input.dataset.price);
                const total = (quantity * price).toFixed(2);

                const totalCell = document.querySelector(`.total[data-id="${id}"]`);
                totalCell.textContent = total;
                totalCell.setAttribute('data-total', total);

                updateInvoiceTotal();
            }

            // تحديث الإجمالي الإجمالي للفاتورة
            function updateInvoiceTotal() {
                let sum = 0;
                document.querySelectorAll('.total').forEach(cell => {
                    const val = parseFloat(cell.getAttribute('data-total')) || 0;
                    sum += val;
                });

                const invoiceTotal = document.getElementById('invoiceTotal');
                invoiceTotal.value = sum.toFixed(2); // تحديث القيمة داخل input

                updateFinalTotal(sum);
            }

            // تحديث إجمالي الفاتورة بعد حساب الرسوم والخصم
            function updateFinalTotal(subtotal) {
                const extra = parseFloat(document.getElementById('extraFees').value) || 0;
                const discount = parseFloat(document.getElementById('discount').value) || 0;
                const final = subtotal + extra - discount;

                document.getElementById('finalTotal').value = final.toFixed(2); // تحديث القيمة داخل input
            }

            // إضافة حدث عند تغيير الرسوم والخصم
            document.getElementById('extraFees').addEventListener('input', function() {
                updateFinalTotal(parseFloat(document.getElementById('invoiceTotal').value) || 0);
            });

            document.getElementById('discount').addEventListener('input', function() {
                updateFinalTotal(parseFloat(document.getElementById('invoiceTotal').value) || 0);
            });
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
