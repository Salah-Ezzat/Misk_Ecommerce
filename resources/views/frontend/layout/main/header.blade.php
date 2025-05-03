<body>
    <!--============================
      HEADER START
  ==============================-->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-2 col-md-1 d-lg-none">
                    <div class="wsus__mobile_menu_area">
                        <span class="wsus__mobile_menu_icon"><i class="fal fa-bars"></i></span>
                    </div>
                </div>
                <div class="col-xl-2 col-7 col-md-8 col-lg-2">
                    <div class="wsus_logo_area">
                        <a class="wsus__header_logo" href="index.html">
                            <img src="{{ asset('frontend/images/logo_2.png') }}" alt="logo" class="img-fluid w-100">
                        </a>
                    </div>
                </div>
                <div class="col-xl-5 col-md-6 col-lg-4 d-none d-lg-block">
                    <div class="wsus__search">
                        <form>
                            <input type="text" placeholder="Search...">
                            <button type="submit"><i class="far fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-xl-5 col-3 col-md-3 col-lg-6">
                    <div class="wsus__call_icon_area">
                        <div class="wsus__call_area">
                            <div class="wsus__call">
                                <i class="fas fa-user-headset"></i>
                            </div>
                            <div class="wsus__call_text">
                                <p>{{ Auth::user()->shop }}</p>
                                <p>{{ Auth::user()->cityRelation->city }}</p>
                            </div>
                        </div>
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
                        <ul class="wsus__icon_area">
                            <li><a href="{{ route('invoices.newInvoices') }}"><i class="fal fa-heart"></i>
                                    @if ($newInvoices > 0)
                                        <span>{{ $newInvoices }}</span>
                                    @endif
                                </a>
                            </li>
                            <li><a href="{{ route('invoices.preparedInvoices') }}"><i class="fal fa-random"></i>
                                    @if ($preparedInvoices > 0)
                                        <span>{{ $preparedInvoices }}</span>
                                    @endif
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </header>
    <!--============================
      HEADER END
  ==============================-->
