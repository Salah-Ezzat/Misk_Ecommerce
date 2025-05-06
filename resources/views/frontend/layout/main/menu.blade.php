    <!--============================
        MAIN MENU START
    ==============================-->
    <nav class="wsus__main_menu d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="relative_contect d-flex">


                        @auth
                            <div class="wsus_menu_category_bar">
                                <i class="far fa-bars"></i>
                            </div>
                            <ul class="wsus_menu_cat_item show_home toggle_menu">
                                <li><a class="active" href=""><i class="fas fa-tachometer"></i>Dashboard</a></li>
                                @if(auth()->user()->role_id == 4)
                                <li><a href="{{ route('categories.index') }}">الأقسام</a></li>
                                <li><a href="{{ route('products.index') }}">المنتجات</a></li>
                                <li><a href="{{ route('invoices.suspendInvoices') }}">فواتير معلقة</a></li>
                                <li><a href="{{ route('users.index') }}">قائمة العملاء</a></li>
                                <li><a href="{{ route('users.confirm_add') }}">طلبات الإضافة</a></li>
                                <li><a href="{{ route('provinces.index') }}">إدارة المحافظات</a></li>
                                <li><a href="{{ route('cities.index') }}">إدارة المدن</a></li>
                                <li><a href="{{ route('evaluations.filter') }}">تقارير العملاء</a></li>
                                <li><a href="{{ route('evaluations.howMany') }}">إحصائيات العملاء</a></li>
                                <li><a href="{{ route('banners.index') }}">الإعلانات</a></li>
                                @elseif (auth()->user()->role_id == 2|| auth()->user()->role_id == 3)
                                <li><a href="{{ route('invoices.newInvoices') }}"><i class="fas fa-file-invoice"></i>
                                        فواتير
                                        جديدة</a></li>
                                <li><a href="{{ route('invoices.doneInvoices') }}"><i class="fas fa-check-circle"></i>
                                        فواتير منفذة</a></li>
                                <li><a href="{{ route('invoices.preparedInvoices') }}"><i class="fas fa-hourglass-half"></i>
                                        فواتير قيد التحصير</a></li>
                                <li><a href="{{ route('invoices.cancelledInvoices') }}"><i class="fas fa-times-circle"></i>
                                        فواتير ملغاة</a></li>
                                <li><a href="dsahboard_order.html"><i class="fas fa-list-ul"></i> الفواتير المعلقة</a>
                                </li>
                                @endif
                                <li><a href="dsahboard_order.html"><i class="fas fa-list-ul"></i> مشترياتي</a></li>
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

                            <ul class="wsus__menu_item wsus__menu_item_right">
                                <li><a href="{{ route('profile') }}" class="text-primary fw-bold">بياناتي</a></li>

                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="text-danger fw-bold">تسجيل
                                        خروج</a>
                                </li>
                            </ul>
                        @else
                            <ul class="wsus__menu_item wsus__menu_item_right ms-auto">
                                <li>
                                    <a href="{{ route('login') }}" class="text-primary fw-bold">تسجيل الدخول</a>
                                </li>
                                @if (Route::has('register'))
                                    <li>
                                        <a href="{{ route('register') }}" class="text-success fw-bold">إنشاء حساب</a>
                                    </li>
                                @endif
                            </ul>
                        @endauth


                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!--============================
        MAIN MENU END
    ==============================-->
