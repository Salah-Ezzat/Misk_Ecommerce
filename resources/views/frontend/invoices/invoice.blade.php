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
                                    <p>{{ $invoice->user->city .'-'. $invoice->user->province }}</p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                <div class="wsus__invoice_single text-md-center">
                                    <h5>رقم الفاتورة : {{ $invoice->id }}</h5>
                                    <h6>قيمة الفاتورة : {{ $invoice->invoice_total }}</h6>
                                    <p>تنفيذ : {{ $invoice->real_total }}</p>
                                    
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4">
                                <div class="wsus__invoice_single text-md-end">
                                    <h5>المشتري</h5>
                                    <h6>{{ $invoice->seller->shop }}</h6>
                                    <p>تليفون :{{ $invoice->seller->phone }}</p>
                                    <p>العنوان :{{ $invoice->seller->address }}</p>
                                    <p>{{ $invoice->seller->city .'-'. $invoice->seller->province }}</p>
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
                                        <img src="{{ asset('backend/assets/img/images/'.$cart->product->firstImage->image) }}" alt="product" class="img-fluid w-100">
                                    </td>

                                    <td class="name">
                                        <p> {{ $cart->product->product }}</p>
                                        <span>{{ $cart->product->pack }}</span>
                                    </td>
                                    <td class="amount">
                                        {{ $cart->price }}
                                    </td>

                                    <td class="quentity">
                                       {{ $cart->new_quantity }}
                                    </td>
                                    <td class="total">
                                        {{ $cart->new_total }}
                                    </td>
                                </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
                <div class="wsus__invoice_footer">
 
                    <p><span>إجمالي الفاتورة:</span> جنيه {{ $invoice->real_total }} </p>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        INVOICE PAGE END
    ==============================-->
@endsection
