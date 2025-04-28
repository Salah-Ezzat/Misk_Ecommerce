@extends('frontend.layout.main.master')

@section('banner')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>{{ $shop->shop }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                <div class="wsus__cart_list wishlist">
                    <div class="table-responsive">
                        <table>
                            <tbody>
                                <tr class="d-flex">
                                    <th class="wsus__pro_img">
                                        product item
                                    </th>

                                    <th class="wsus__pro_name">
                                        product details
                                    </th>


                                    <th class="wsus__pro_tk">
                                        price
                                    </th>

                                    <th class="wsus__pro_select">
                                        quantity
                                    </th>

                                    <th class="wsus__pro_tk">
                                        price
                                    </th>

                                    <th class="wsus__pro_icon">
                                        action
                                    </th>
                                </tr>
                                @foreach ($products as $product)
                                    @php
                                        $stock = $product->stocks->where('user_id', $userId)->first();
                                        $price = $stock->price;
                                        $max_limit = $stock->max_limit;
                                        $min_limit = $stock->max_limit;

                                    @endphp

                                    <tr class="d-flex">
                                        <td class="wsus__pro_img"><img
                                                src="{{ asset('backend/assets/img/images/' . $product->firstImage->image) }}"
                                                alt="product" class="img-fluid w-100">

                                        </td>

                                        <td class="wsus__pro_name">
                                            <p>{{ $product->product }}</p>
                                            <p>{{ $product->pack }}</p>
                                        </td>


                                        <td class="wsus__pro_tk">
                                            <h6 class="product-price">{{ number_format($price, 2) }}</h6>
                                        </td>

                                        <td class="wsus__pro_select">
                                            <form class="select_number">
                                                <input class="number_area form-control" type="number" min="0"
                                                    max="{{ $max_limit }}" value="0"
                                                    data-price="{{ $price }}"
                                                    data-target="total_price_{{ $loop->index }}" />
                                            </form>
                                        </td>

                                        <td class="wsus__pro_tk">
                                            <input type="text" id="total_price_{{ $loop->index }}" name="total_prices[]"
                                                class="form-control total_price" value="0" readonly>
                                        </td>



                                        <td class="wsus__pro_icon">
                                            <button type="button" class="common_btn add-to-cart-btn"
                                            data-stock-id="{{ $stock->id }}">
                                            Add to Cart
                                        </button>
                                        

                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" class="text-right">إجمالي السعر لجميع المنتجات:</td>
                                    <td>
                                        <input type="text" id="total_all_products" class="form-control" value="0.00"
                                            readonly>
                                    </td>
                                    <td></td>
                                </tr>





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
@endsection
@section('scripts')
    <!-- Progress Bar -->
    <div class="container mt-5">
        <div class="progress">
            <div id="purchaseProgressBar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="mt-2 text-center">
            <span id="progressMessage">تابع تقدمك نحو الحد الأدنى للشراء</span>
            <div id="progressAmount" class="font-weight-bold">0.00 / 300.00 جنيه</div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        const minLimit = 300; // الحد الأدنى للشراء

        // دالة لقراءة الكوكيز
        function getCookie(name) {
            let nameEQ = name + "=";
            let ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        // دالة لتحديث الـ Progress Bar
        function updateProgressBar() {
            var total = parseFloat(getCookie('total_cart')) || 0;
            var percent = Math.min((total / minLimit) * 100, 100); // التأكد أن النسبة لا تتجاوز 100%

            var progressBar = $('#purchaseProgressBar');
            var progressMessage = $('#progressMessage');
            var progressAmount = $('#progressAmount');

            // تغيير اللون بناءً على التقدم
            progressBar.removeClass('bg-success bg-danger');
            if (total >= minLimit) {
                progressBar.addClass('bg-success');
                progressMessage.text('تهانينا! وصلت للحد الأدنى للشراء');
            } else {
                progressBar.addClass('bg-danger');
                progressMessage.text('تابع تقدمك نحو الحد الأدنى للشراء');
            }

            // تحديث شريط التقدم
            progressBar
                .css('width', percent.toFixed(0) + '%')
                .attr('aria-valuenow', percent.toFixed(0));

            // تحديث المبلغ المعروض
            progressAmount.text(total.toFixed(2) + ' / ' + minLimit.toFixed(2) + ' جنيه');
        }

        $(document).ready(function() {
            // تحديث التقدم عند تحميل الصفحة
            updateProgressBar();

            // تحديث التقدم عند تغيير الكمية
            $('.number_area').on('input', function() {
                updateProgressBar();
            });
        });
    </script>
    

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

        addToCartButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const tr = this.closest('tr'); // يجيب الـ tr اللي جوه الزرار

                const quantityInput = tr.querySelector('.number_area');
                const quantity = quantityInput.value;
                const stockId = this.getAttribute('data-stock-id'); // صح كده

                if (quantity > 0) {
                    fetch('{{ route('order.add') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            stock_id: stockId,
                            quantity: quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            tr.style.display = 'none'; // يخفي الصف
                        } else {
                            alert('حدث خطأ أثناء الإضافة إلى السلة.');
                        }
                    })
                    .catch(error => {
                        console.error('خطأ في الطلب:', error);
                    });
                } else {
                    alert('من فضلك اختر كمية صحيحة.');
                }
            });
        });
    });
</script>

@endsection
