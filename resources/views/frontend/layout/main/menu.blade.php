    <!--============================
        MAIN MENU START
    ==============================-->
    <nav class="wsus__main_menu d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="relative_contect d-flex">
                        <div class="wsus_menu_category_bar">
                            <i class="far fa-bars"></i>
                        </div>
                        <ul class="wsus_menu_cat_item show_home toggle_menu">
                            <li><a class="active" href=""><i class="fas fa-tachometer"></i>Dashboard</a></li>
                            <li><a href="{{ route('invoices.newInvoices') }}"><i class="fas fa-file-invoice"></i>
                                    فواتير
                                    جديدة</a></li>
                            <li><a href="{{ route('invoices.doneInvoices') }}"><i class="fas fa-check-circle"></i>
                                    فواتير منفذة</a></li>
                            <li><a href="{{ route('invoices.preparedInvoices') }}"><i class="fas fa-hourglass-half"></i>
                                    فواتير قيد التحصير</a></li>
                            <li><a href="{{ route('invoices.cancelledInvoices') }}"><i class="fas fa-times-circle"></i>
                                    فواتير ملغاة</a></li>
                            <li><a href="dsahboard_order.html"><i class="fas fa-list-ul"></i> مشترياتي</a></li>
                            <li><a href="dsahboard_order.html"><i class="fas fa-list-ul"></i> الفواتير المعلقة</a>
                            </li>
                            <li><a href="{{ route('users.traders') }}"><i class="fas fa-store"></i> تجار الجملة</a>
                            </li>
                            <li><a href="{{ route('users.wholesalers') }}"><i class="fas fa-warehouse"></i> تجار
                                    جملة
                                    الجملة</a></li>
                            <li><a href="{{ route('stocks.index') }}"><i class="fas fa-clipboard-list"></i> بضاعة
                                    غير
                                    معروضة</a></li>
                            <li><a href="{{ route('stocks.displayed') }}"><i class="fas fa-store"></i> البضاعة
                                    المعروضة</a></li>
                        </ul>

                        <ul class="wsus__menu_item">
                            <li><a class="active" href="index.html">home</a></li>
                            <li class="wsus__relative_li" ><a href="#">الأقسام <i class="fas fa-caret-down"></i></a>
                                <ul class="wsus__menu_droapdown" style="max-height: 500px; overflow-y: auto;">
                                    @php
                                        use App\Models\Category;
                                        $categories = Category::all();
                                    @endphp
                                    @foreach ($categories as $category)
                                        <li><a href="#"><i class="fas fa-star"></i> {{ $category->category }}</a>
                                        </li>
                                    @endforeach
                                    <li><a href="#"><i class="fal fa-gem"></i> View All Categories</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="wsus__menu_item wsus__menu_item_right">
                            <li><a href="contact.html">contact</a></li>
                            <li><a href="dsahboard.html">my account</a></li>
                            <li><a href="login.html">login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!--============================
        MAIN MENU END
    ==============================-->
