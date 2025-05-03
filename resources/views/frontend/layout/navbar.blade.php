 <!--=============================
    DASHBOARD MENU START
  ==============================-->
  <div class="wsus__dashboard_menu">
    <div class="wsusd__dashboard_user">
      <img src="{{ asset('backend/assets/img/images/'.(Auth::user()?->image->image??'No_Image.jpg')) }}" alt="img" class="img-fluid">
      <p>{{ Auth::user()->shop }}</p>
    </div>
  </div>
  <!--=============================
    DASHBOARD MENU END
  ==============================-->
