<style>
    #pills-home {
        max-height: 500px;
        overflow-y: auto;
        padding-right: 10px;
        /* مساحة بسيطة للـ scrollbar */
    }

    /* تنسيق الشريط الجانبي للتمرير */
    #pills-home::-webkit-scrollbar {
        width: 8px;
    }

    #pills-home::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    #pills-home::-webkit-scrollbar-thumb {
        background: #007bff;
        border-radius: 10px;
    }

    #pills-home::-webkit-scrollbar-thumb:hover {
        background: #0056b3;
    }
</style>

<section id="wsus__dashboard">
    <div class="container-fluid">
        <div class="dashboard_sidebar">
            <span class="close_icon">
                <i class="far fa-bars dash_bar"></i>
                <i class="far fa-times dash_close"></i>
            </span>
            <a href="dsahboard.html" class="dash_logo"><img src="{{ asset('frontend/images/logo.png') }}" alt="logo"
                    class="img-fluid"></a>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item active" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" role="tab" aria-controls="pills-profile"
                        aria-selected="false">القائمة الرئيسية</button>
                </li>

                @yield('sidebar_tabs')
            </ul>
            <div class="tab-content" id="pills-tabContent">
                @yield('categories_list')

                <div class="tab-pane fade show-active" id="pills-profile" role="tabpanel"
                    aria-labelledby="pills-profile-tab">
                    <div class="wsus__mobile_menu_main_menu">
                        <div class="accordion accordion-flush" id="accordionFlushExample2">
                            <ul class="dashboard_link">

                                @if (Auth::user()->role_id == 4)
                                    <li><a href="{{ route('categories.index') }}"><i class="fas fa-th-large"></i>
                                            الأقسام</a></li>
                                    <li><a href="{{ route('products.index') }}"><i class="fas fa-box-open"></i>
                                            المنتجات</a></li>
                                    <li><a href="{{ route('invoices.suspendInvoices') }}"><i
                                                class="fas fa-box-open"></i> فواتير معلقة</a></li>
                                    <li><a href="{{ route('users.index') }}"><i class="fas fa-users"></i> قائمة
                                            العملاء</a></li>
                                    <li><a href="{{ route('users.confirm_add') }}"><i class="fas fa-user-plus"></i>
                                            طلبات الإضافة</a></li>
                                    <li><a href="{{ route('provinces.index') }}"><i class="fas fa-map-marked-alt"></i>
                                            إدارة المحافظات</a></li>
                                    <li><a href="{{ route('cities.index') }}"><i class="fas fa-map-marker-alt"></i>
                                            إدارة المدن</a></li>
                                    <li><a href="{{ route('evaluations.filter') }}"><i class="fas fa-chart-line"></i>
                                            تقارير العملاء</a></li>
                                    <li><a href="{{ route('evaluations.howMany') }}"><i class="fas fa-chart-bar"></i>
                                            إحصائيات العملاء</a></li>
                                    <li><a href="{{ route('banners.index') }}"><i class="fas fa-bullhorn"></i>
                                            الإعلانات</a></li>
                                @elseif (Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                                    <li><a class="active" href="{{ route('users.index') }}"><i
                                                class="fas fa-tachometer"></i>إدارة الموقع</a></li>
                                    <li><a href="{{ route('invoices.newInvoices') }}"><i
                                                class="fas fa-file-invoice"></i>
                                            فواتير
                                            جديدة</a></li>
                                    <li><a href="{{ route('invoices.doneInvoices') }}"><i
                                                class="fas fa-check-circle"></i>
                                            فواتير منفذة</a></li>
                                    <li><a href="{{ route('invoices.preparedInvoices') }}"><i
                                                class="fas fa-hourglass-half"></i>
                                            فواتير قيد التحصير</a></li>
                                    <li><a href="{{ route('invoices.cancelledInvoices') }}"><i
                                                class="fas fa-times-circle"></i>
                                            فواتير ملغاة</a></li>
                                    <li><a href="{{ route('invoices.myInvoices') }}"><i class="fas fa-list-ul"></i>
                                            مشترياتي</a></li>
                                    </li>
                                @endif
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
                                <li><a href="{{ route('profile') }}"><i class="far fa-user"></i> بياناتي</a></li>
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                            class="far fa-sign-out-alt"></i> تسجيل خروج</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
