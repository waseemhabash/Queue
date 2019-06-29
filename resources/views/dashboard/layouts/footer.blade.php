</div>
</div>
</div>
<div class="footer clearfix">
    <div class="footer-inner">
        {{ date("Y") }} &copy; QueueLines.
    </div>
    <div class="footer-items">
        <span class="go-top"><i class="clip-chevron-up"></i></span>
    </div>
</div>

<script src="{{ url('/assets/dashboard') }}/js/jquery.js"></script>
<script src="{{ url('/assets/dashboard') }}/js/jquery-ui.min.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js">
</script>
<script src="{{ url('/assets/dashboard') }}/plugins/blockUI/jquery.blockUI.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/iCheck/jquery.icheck.min.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/perfect-scrollbar/src/perfect-scrollbar-rtl.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/less/less-1.5.0.min.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/jquery-cookie/jquery.cookie.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js">
</script>
<script src="{{ url('/assets/dashboard') }}/js/main.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/flot/jquery.flot.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/flot/jquery.flot.pie.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/jquery.sparkline/jquery.sparkline.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/fullcalendar/fullcalendar/fullcalendar.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/select2/select2.min.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/jQuery-Tags-Input/jquery.tagsinput.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/summernote/build/summernote.min.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js">
</script>
<script src="{{ url('/assets/dashboard') }}/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/ckeditor/ckeditor.js"></script>
<script src="{{ url('/assets/dashboard') }}/plugins/ckeditor/adapters/jquery.js"></script>
<script src="{{ url('/assets/dashboard') }}/js/form-elements.js"></script>
<script src="{{ url('/assets/dashboard') }}/js/mapboxGL.js"></script>
<script src="{{ url('/assets/dashboard') }}/js/mapboxGEOCODER.js"></script>
<script src="{{ url('/assets/dashboard') }}/js/Chart.min.js"></script>

<script>
    jQuery(document).ready(function () {
        Main.init();
        FormElements.init();
    });

    $(".nav-tabs li a").click(function () {
        var url = "{{ url('/') }}";
        var hash = $(this).attr("href");

        hash = hash.substring(1, hash.length); //remove #
        $.ajax({
            url: url + "/dashboard/change_hash_tab/" + hash
        });
    });

    mapboxgl.accessToken =
        'pk.eyJ1Ijoid2FzZWVtYWxoYWJhc2giLCJhIjoiY2pzcWo3MmgyMTRlNTQ0bzQ1MWMyOGtzZSJ9.Hk7_kl2Oh9TH-i8513BV1g';
    mapboxgl.setRTLTextPlugin('{{ url("/assets/dashboard") }}/js/mapboxRTL.js');

</script>


</body>
</html>
