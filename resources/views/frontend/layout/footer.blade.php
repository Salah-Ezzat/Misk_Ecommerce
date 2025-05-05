</div>
</section>
<!--=============================
    DASHBOARD START
  ==============================-->


<!--============================
      SCROLL BUTTON START
    ==============================-->
<div class="wsus__scroll_btn">
    <i class="fas fa-chevron-up"></i>
</div>
<!--============================
    SCROLL BUTTON  END
  ==============================-->


<!--jquery library js-->
<script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
<!--bootstrap js-->
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
<!--font-awesome js-->
<script src="{{ asset('frontend/js/Font-Awesome.js') }}"></script>
<!--select2 js-->
<script src="{{ asset('frontend/js/select2.min.js') }}"></script>
<!--slick slider js-->
<script src="{{ asset('frontend/js/slick.min.js') }}"></script>
<!--simplyCountdown js-->
<script src="{{ asset('frontend/js/simplyCountdown.js') }}"></script>
<!--product zoomer js-->
<script src="{{ asset('frontend/js/jquery.exzoom.js') }}"></script>
<!--nice-number js-->
<script src="{{ asset('frontend/js/jquery.nice-number.min.js') }}"></script>
<!--counter js-->
<script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.countup.min.js') }}"></script>
<!--add row js-->
<script src="{{ asset('frontend/js/add_row_custon.js') }}"></script>
<!--multiple-image-video js-->
<script src="{{ asset('frontend/js/multiple-image-video.js') }}"></script>
<!--sticky sidebar js-->
<script src="{{ asset('frontend/js/sticky_sidebar.js') }}"></script>
<!--price ranger js-->
<script src="{{ asset('frontend/js/ranger_jquery-ui.min.js') }}"></script>
<script src="{{ asset('frontend/js/ranger_slider.js') }}"></script>
<!--isotope js-->
<script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
<!--venobox js-->
<script src="{{ asset('frontend/js/venobox.min.js') }}"></script>
<!--classycountdown js-->
<script src="{{ asset('frontend/js/jquery.classycountdown.js') }}"></script>

<!--main/custom js-->
<script src="{{ asset('frontend/js/main.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // حفظ التبويب عند التبديل
        document.querySelectorAll('[data-bs-toggle="pill"]').forEach(button => {
            button.addEventListener("shown.bs.tab", function(e) {
                const activeTabId = e.target.id;
                sessionStorage.setItem("activeTabId", activeTabId);
            });
        });

        // استعادة التبويب عند تحميل الصفحة
        const savedTabId = sessionStorage.getItem("activeTabId");
        if (savedTabId) {
            const tab = document.getElementById(savedTabId);
            if (tab) {
                new bootstrap.Tab(tab).show();
            }
        } else {
            // تعيين تبويب افتراضي لو مفيش محفوظ
            new bootstrap.Tab(document.getElementById("pills-profile-tab")).show();
        }
    });
</script>

</body>

</html>
