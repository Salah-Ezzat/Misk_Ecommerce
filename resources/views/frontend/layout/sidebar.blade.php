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
                <li><a href="{{ route('invoices.newInvoices') }}"><i class="fas fa-file-invoice"></i> فواتير جديدة</a></li>
                <li><a href="{{ route('invoices.doneInvoices') }}"><i class="fas fa-check-circle"></i> فواتير منفذة</a></li>
                <li><a href="{{ route('invoices.preparedInvoices') }}"><i class="fas fa-hourglass-half"></i> فواتير قيد التحصير</a></li>
                <li><a href="{{ route('invoices.cancelledInvoices') }}"><i class="fas fa-times-circle"></i> فواتير ملغاة</a></li>
                <li><a href="dsahboard_order.html"><i class="fas fa-list-ul"></i> مشترياتي</a></li>
                <li><a href="dsahboard_order.html"><i class="fas fa-list-ul"></i>  الفواتير المعلقة</a></li>
                <li><a href="{{ route('users.traders') }}"><i class="fas fa-store"></i> تجار الجملة</a></li>
                <li><a href="{{ route('users.wholesalers') }}"><i class="fas fa-warehouse"></i> تجار جملة الجملة</a></li>
                <li><a href="{{ route('stocks.index') }}"><i class="fas fa-clipboard-list"></i> بضاعة غير معروضة</a></li>
                <li><a href="{{ route('stocks.displayed') }}"><i class="fas fa-store"></i> البضاعة المعروضة</a></li>
                <li><a href="dsahboard_profile.html"><i class="far fa-user"></i> My Profile</a></li>
                <li><a href="dsahboard_address.html"><i class="fal fa-gift-card"></i> Addresses</a></li>
                <li><a href="#"><i class="far fa-sign-out-alt"></i> Log out</a></li>
            </ul>
        </div>