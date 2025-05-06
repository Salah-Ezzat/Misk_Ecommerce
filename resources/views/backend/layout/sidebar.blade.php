<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">لوحة التحكم</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">لو</a>
        </div>

        <ul class="sidebar-menu">

            <li>
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>الصفحة الرئيسية</span>
                </a>
            </li>

            <li>
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <i class="fas fa-th-large"></i>
                    <span>الأقسام</span>
                </a>
            </li>

            <li>
                <a class="nav-link" href="{{ route('products.index') }}">
                    <i class="fas fa-box-open"></i>
                    <span>المنتجات</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('invoices.suspendInvoices') }}">
                    <i class="fas fa-box-open"></i>
                    <span>فواتير معلقة</span>
                </a>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-users"></i>
                    <span>إدارة العملاء</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('users.index') }}">قائمة العملاء</a></li>
                    <li><a class="nav-link" href="{{ route('users.confirm_add') }}">طلبات الإضافة</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-map-marked-alt"></i>
                    <span>المحافظات والمدن</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('provinces.index') }}">إدارة المحافظات</a></li>
                    <li><a class="nav-link" href="{{ route('cities.index') }}">إدارة المدن</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-chart-line"></i>
                    <span>تقارير العملاء </span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('evaluations.filter') }}">تقارير </a></li>
                    <li><a class="nav-link" href="{{ route('evaluations.howMany') }}">إحصائيات </a></li>
                </ul>
            </li>
            <li>
                <a class="nav-link" href="{{ route('banners.index') }}">
                    <i class="fas fa-bullhorn"></i>
                    <span>الإعلانات</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-store"></i>
                    <span> التجار </span>
                </a>
                <ul class="dropdown-menu">
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
            <li><a href="{{ route('profile') }}"><i class="far fa-user"></i> بياناتي</a></li>
            <li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                     class="fas fa-sign-out-alt"></i> تسجيل خروج</a>
            </li>

        </ul>
    </aside>
</div>
