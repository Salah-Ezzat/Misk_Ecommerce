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

                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" role="tab" aria-controls="pills-profile"
                        aria-selected="false">القائمة الرئيسية</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link " id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                        role="tab" aria-controls="pills-home" aria-selected="true">الأقسام</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="wsus__mobile_menu_main_menu">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <ul class="wsus_mobile_menu_category">
                                @php
                                    use App\Models\Category;
                                    $categories = Category::all();
                                @endphp
                                @foreach ($categories as $category)
                                    <li><a href="#"><i class="fas fa-star"></i> {{ $category->category }}</a></li>
                                @endforeach
                                <li><a href="#"><i class="fal fa-gem"></i> View All Categories</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                    aria-labelledby="pills-profile-tab">
                    <div class="wsus__mobile_menu_main_menu">
                        <div class="accordion accordion-flush" id="accordionFlushExample2">
                            <ul class="dashboard_link">
                                <li><a class="active" href=""><i class="fas fa-tachometer"></i>Dashboard</a></li>
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
                                <li><a href="dsahboard_profile.html"><i class="far fa-user"></i> My Profile</a></li>
                                <li><a href="dsahboard_address.html"><i class="fal fa-gift-card"></i> Addresses</a></li>
                                <li><a href="#"><i class="far fa-sign-out-alt"></i> Log out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
