<section id="wsus__dashboard">
    <div class="container-fluid">
        <div class="dashboard_sidebar">
            <span class="close_icon">
                <i class="far fa-bars dash_bar"></i>
                <i class="far fa-times dash_close"></i>
            </span>
            <a href="dsahboard.html" class="dash_logo"><img src="{{ asset('frontend/images/logo.png') }}" alt="logo"
                    class="img-fluid"></a>
            <ul class="dashboard_link">
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
                <li><a href="{{ route('invoices.myInvoices') }}"><i class="fas fa-list-ul"></i> مشترياتي</a></li>
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
                <li><a href="{{ route('profile') }}"><i class="far fa-user"></i> بياناتي</a></li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="far fa-sign-out-alt"></i> تسجيل خروج</a>
                </li>
            </ul>
        </div>
