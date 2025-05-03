@extends('frontend.layout.main.master')

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
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td class="images">
                                            <img src="{{ $cart->product && $cart->product->firstImage
                                                ? asset('backend/assets/img/images/' . $cart->product->firstImage->image)
                                                : asset('backend/assets/img/images/No_Image.jpg') }}"
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
                                            {{ $cart->new_quantity == 0 ? $cart->quantity : $cart->new_quantity }}
                                        </td>
                                        <td class="total">
                                            {{ number_format(($cart->new_quantity == 0 ? $cart->quantity : $cart->new_quantity) * $cart->price, 2) }}
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
                <div class="wsus__invoice_footer">

                    <p><span>إجمالي الفاتورة:</span> جنيه {{ number_format($invoice->real_total == 0 ? $invoice->invoice_total: $invoice->real_total, 2) }} </p>
                </div>
                <div class="text-center my-4">
                    <!-- زر العودة -->
                    <div class="mt-4">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> عودة
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--============================
                INVOICE PAGE END
            ==============================-->
@endsection
