
				</div>
			</div>
			<!-- end: PAGE -->
		</div>
		<!-- end: MAIN CONTAINER -->
		<!-- start: FOOTER -->
		<div class="footer clearfix">
			<div class="footer-inner">
				{{ date("Y") }} &copy; QueueLines.
			</div>
			<div class="footer-items">
				<span class="go-top"><i class="clip-chevron-up"></i></span>
			</div>
		</div>
		<!-- end: FOOTER -->

		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="assets/plugins/respond.min.js"></script>
		<script src="assets/plugins/excanvas.min.js"></script>
		<![endif]-->
        
        
		<script src="{{ url('/dashboard') }}/assets/js/jquery.js"></script>
		<script src="{{ url('/dashboard') }}/assets/js/jquery-ui.min.js"></script>
		<script src="{{ url('/dashboard') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="{{ url('/dashboard') }}/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="{{ url('/dashboard') }}/assets/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="{{ url('/dashboard') }}/assets/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="{{ url('/dashboard') }}/assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="{{ url('/dashboard') }}/assets/plugins/perfect-scrollbar/src/perfect-scrollbar-rtl.js"></script>
		<script src="{{ url('/dashboard') }}/assets/plugins/less/less-1.5.0.min.js"></script>
		<script src="{{ url('/dashboard') }}/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="{{ url('/dashboard') }}/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="{{ url('/dashboard') }}/assets/js/main.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="{{ url('/dashboard') }}/assets/plugins/flot/jquery.flot.js"></script>
		<script src="{{ url('/dashboard') }}/assets/plugins/flot/jquery.flot.pie.js"></script>
		<script src="{{ url('/dashboard') }}/assets/plugins/flot/jquery.flot.resize.min.js"></script>
		<script src="{{ url('/dashboard') }}/assets/plugins/jquery.sparkline/jquery.sparkline.js"></script>
		<script src="{{ url('/dashboard') }}/assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
		<script src="{{ url('/dashboard') }}/assets/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
		<script src="{{ url('/dashboard') }}/assets/plugins/fullcalendar/fullcalendar/fullcalendar.js"></script>
		<script src="{{ url('/dashboard') }}/assets/plugins/select2/select2.min.js"></script>

		<script src="{{ url('/dashboard') }}/assets/plugins/summernote/build/summernote.min.js"></script>

		<script src="{{ url('/dashboard') }}/assets/plugins/ckeditor/ckeditor.js"></script>

		<script src="{{ url('/dashboard') }}/assets/plugins/ckeditor/adapters/jquery.js"></script>

		<script src="{{ url('/dashboard') }}/assets/js/form-elements.js"></script>

		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();

			});
		</script>
	</body>
	<!-- end: BODY -->
</html>