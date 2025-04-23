@extends('frontend.layout.main')

@section('content')
<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-heart"></i> بضاعة غير معروضة</h3>
            <div class="wsus__dashboard_wishlist">
                <div class="row">
                    <div class="col-12">
                        <div class="wsus__cart_list wishlist">
                            <div class="table-responsive">
                                <table>
                                    <tbody>
                                        <tr class="d-flex">
                                            <th class="wsus__pro_img">
                                                صورة المنتج
                                            </th>

                                            <th class="wsus__pro_name">
                                                المنتج
                                            </th>


                                            <th class="wsus__pro_tk">
                                                العبوة
                                            </th>

                                            <th class="wsus__pro_icon">
                                                إضافة للمعروض
                                            </th>
                                        </tr>

                                        @foreach ($products as $product )
                                            
                                        
                                        <tr class="d-flex">
                                            <td class="wsus__pro_img"><img src="{{ asset('backend/assets/img/images/'.($product->firstImage?->image??'No_Image.jpg')) }}"
                                                    alt="product" class="img-fluid w-100">
                                                
                                            </td>

                                            <td class="wsus__pro_name">
                                                <a>{{ $product->product }}</a>
                                            </td>



                                            <td class="wsus__pro_tk">
                                                <h6>{{ $product->pack }}</h6>
                                            </td>

                                            <td class="wsus__pro_icon">
                                                <a class="common_btn" href="#">إضافة للمعروض</a>
                                            </td>
                                        </tr>
                                        @endforeach
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
        </div>
    </div>
</div>
@endsection