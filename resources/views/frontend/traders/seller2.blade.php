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

                                    <th class="wsus__pro_status">
                                        status
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
                                            <a href="#"><i class="far fa-times"></i></a>
                                        </td>

                                        <td class="wsus__pro_name">
                                            <p>{{ $product->product }}</p>
                                        </td>

                                        <td class="wsus__pro_status">
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
                                                class="form-control total_price" value="0"
                                                readonly>
                                        </td>



                                        <td class="wsus__pro_icon">
                                            <a class="common_btn" href="#">add to cart</a>
                                        </td>
                                    </tr>
                                @endforeach
                            
                                    
                                    
                                        <input type="hidden" id="total_all_products" class="form-control" value="0.00"
                                            readonly>
                                    
                                
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
