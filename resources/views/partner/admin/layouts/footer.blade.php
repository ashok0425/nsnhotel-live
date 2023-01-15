		<!-- start footer -->
		<div class="page-footer">
			<div class="page-footer-inner"> 2021 &copy; Nsnhotels</a>
			</div>
			<div class="scroll-to-top">
				<i class="icon-arrow-up"></i>
			</div>
		</div>
		<!-- end footer -->
	</div>
	<!-- start js include path -->
	<script src="{{asset('/admin/assets/plugins/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('/admin/assets/plugins/popper/popper.min.js')}}"></script>
	<script src="{{asset('/admin/assets/plugins/jquery-blockui/jquery.blockui.min.js')}}"></script>
	<script src="{{asset('/admin/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
	<!-- bootstrap -->
	<script src="{{asset('/admin/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('/admin/assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
	<script src="{{asset('/admin/assets/js/pages/sparkline/sparkline-data.js')}}"></script>
	<!-- Common js-->
	<script src="{{asset('/admin/assets/js/app.js')}}"></script>
	<script src="{{asset('/admin/assets/js/layout.js')}}"></script>
	<script src="{{asset('/admin/assets/js/theme-color.js')}}"></script>
	<!-- material -->
	<script src="{{asset('/admin/assets/plugins/material/material.min.js')}}"></script>
	<!-- animation -->
	<script src="{{asset('/admin/assets/js/pages/ui/animations.js')}}"></script>
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=e8cgxme8kbsc3u65sf2y8iixj1z0mzqlejahfw9hp9yoi1to"></script>
	<script src="{{asset('/admin/assets/plugins/chosen/chosen.jquery.min.js')}}"></script>
	<!-- morris chart -->
	<!-- <script src="{{asset('/admin/assets/plugins/morris/morris.min.js')}}"></script>
	<script src="{{asset('/admin/assets/plugins/morris/raphael-min.js')}}"></script>
	<script src="{{asset('/admin/assets/js/pages/chart/morris/morris_home_data.js')}}"></script> -->
	<script src="{{asset('/admin/assets/plugins/switchery/dist/switchery.min.js')}}"></script>
	<script src="{{asset('/admin/assets/plugins/pnotify/dist/pnotify.js')}}"></script>
	<script src="{{asset('/admin/assets/plugins/pnotify/dist/pnotify.buttons.js')}}"></script>
	<script src="{{asset('/admin/assets/plugins/pnotify/dist/pnotify.nonblock.js')}}"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="{{asset('/admin/assets/js/commons.js')}}"></script>
	
	@stack('scripts')
	
	@if (session('error'))
    <script>
        notify("{{ session('error') }}", "error");
    </script>
	@endif
	@if (session('success'))
	    <script>
	        notify("{{ session('success') }}");
	    </script>
	@endif

	<script src="https://maps.googleapis.com/maps/api/js?key={{setting('goolge_map_api_key', 'AIzaSyBkYZ3pUwM6uOXwg9FrVfcbxXG_GmY0lrs')}}&callback=placeMap&libraries=places"async></script>
	<!-- end js include path -->
	