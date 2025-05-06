    <!--============================
        MOBILE MENU START
    ==============================-->

    <section id="wsus__mobile_menu">
        <span class="wsus__mobile_menu_close"><i class="fal fa-times"></i></span>
        <ul class="wsus__mobile_menu_header_icon d-inline-flex">
            @php
                use App\Models\Invoice;

                $preparedInvoices = Invoice::where('seller_id', Auth::user()->id)
                    ->where('done', 0)
                    ->where('confirm', 1)
                    ->where('prepare', 1)
                    ->count();
                $newInvoices = Invoice::where('seller_id', Auth::user()->id)
                    ->where('done', 0)
                    ->where('confirm', 1)
                    ->where('prepare', 0)
                    ->count();
            @endphp

            <li><a href="{{ route('invoices.newInvoices') }}"><i class="far fa-heart"></i>
                    @if ($newInvoices > 0)
                        <span>{{ $newInvoices }}</span>
                    @endif
                </a></li>

            <li><a href="{{ route('invoices.preparedInvoices') }}"><i class="far fa-random"></i> </i>
                    @if ($preparedInvoices > 0)
                        <span>{{ $preparedInvoices }}</span>
                    @endif
                </a></li>
        </ul>
        <form>
            <input type="text" placeholder="Search">
            <button type="submit"><i class="far fa-search"></i></button>
        </form>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                aria-labelledby="pills-profile-tab">
                <div class="wsus__mobile_menu_main_menu">
                    <div class="accordion accordion-flush" id="accordionFlushExample2">
                        <ul class="dashboard_link">
                            <li><a class="active" href=""><i class="fas fa-tachometer"></i>Dashboard</a></li>
                            @if (auth()->user()->role_id == 4)
                            <li><a href="{{ route('categories.index') }}"><i class="fas fa-th-large"></i> الأقسام</a></li>
                            <li><a href="{{ route('products.index') }}"><i class="fas fa-box-open"></i> المنتجات</a></li>
                            <li><a href="{{ route('invoices.suspendInvoices') }}"><i class="fas fa-box-open"></i> فواتير معلقة</a></li>
                            <li><a href="{{ route('users.index') }}"><i class="fas fa-users"></i> قائمة العملاء</a></li>
                            <li><a href="{{ route('users.confirm_add') }}"><i class="fas fa-user-plus"></i> طلبات الإضافة</a></li>
                            <li><a href="{{ route('provinces.index') }}"><i class="fas fa-map-marked-alt"></i> إدارة المحافظات</a></li>
                            <li><a href="{{ route('cities.index') }}"><i class="fas fa-map-marker-alt"></i> إدارة المدن</a></li>
                            <li><a href="{{ route('evaluations.filter') }}"><i class="fas fa-chart-line"></i> تقارير العملاء</a></li>
                            <li><a href="{{ route('evaluations.howMany') }}"><i class="fas fa-chart-bar"></i> إحصائيات العملاء</a></li>
                            <li><a href="{{ route('banners.index') }}"><i class="fas fa-bullhorn"></i> الإعلانات</a></li>
                            
                            @elseif (auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
                                <li><a href="{{ route('invoices.newInvoices') }}"><i class="fas fa-file-invoice"></i>
                                        فواتير
                                        جديدة</a></li>
                                <li><a href="{{ route('invoices.doneInvoices') }}"><i class="fas fa-check-circle"></i>
                                        فواتير منفذة</a></li>
                                <li><a href="{{ route('invoices.preparedInvoices') }}"><i
                                            class="fas fa-hourglass-half"></i>
                                        فواتير قيد التحصير</a></li>
                                <li><a href="{{ route('invoices.cancelledInvoices') }}"><i
                                            class="fas fa-times-circle"></i>
                                        فواتير ملغاة</a></li>
                                <li><a href="{{ route('stocks.index') }}"><i class="fas fa-clipboard-list"></i> بضاعة
                                        غير
                                        معروضة</a></li>
                                <li><a href="{{ route('stocks.displayed') }}"><i class="fas fa-store"></i> البضاعة
                                        المعروضة</a></li>
                            @endif
                            <li><a href="{{ route('invoices.myInvoices') }}"><i class="fas fa-list-ul"></i>
                                    مشترياتي</a>
                            </li>
                            </li>
                            <li><a href="{{ route('users.traders') }}"><i class="fas fa-store"></i> تجار الجملة</a>
                            </li>
                            <li><a href="{{ route('users.wholesalers') }}"><i class="fas fa-warehouse"></i> تجار
                                    جملة
                                    الجملة</a></li>
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
    </section>

    <!--============================
        MOBILE MENU END
    ==============================-->
