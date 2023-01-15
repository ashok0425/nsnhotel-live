	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta name="description" content="Responsive Admin Template" />
	<meta name="author" content="SmartUniversity" />
	<title>NSN HOTELS</title>
	<!-- icons -->
	<link href="{{asset('/admin/assets/plugins/simple-line-icons/simple-line-icons.min.css')}}" />
	<link href="{{asset('/admin/assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
	<!--bootstrap -->
	<link href="{{asset('/admin/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('/admin/assets/plugins/summernote/summernote.css')}}"/>
	<!-- morris chart -->
	<link href="{{asset('/admin/assets/plugins/morris/morris.css')}}"/>
	<!-- Material Design Lite CSS -->
	<link rel="stylesheet" href="{{asset('/admin/assets/plugins/material/material.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('/admin/assets/css/material_style.css')}}"/>
	<!-- animation -->
	<link href="{{asset('/admin/assets/css/pages/animate_page.css')}}" rel="stylesheet"/>
	<!-- Template Styles -->
	<link href="{{asset('/admin/assets/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('/admin/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('/admin/assets/css/responsive.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('/admin/assets/css/theme-color.css')}}" rel="stylesheet" type="text/css" />
	<!-- switchery -->
	<link href="{{asset('/admin/assets/plugins/switchery/dist/switchery.min.css')}}" rel="stylesheet">
	<link href="{{asset('/admin/assets/plugins/pnotify/dist/pnotify.css')}}" rel="stylesheet">
	<link href="{{asset('/admin/assets/plugins/pnotify/dist/pnotify.buttons.css')}}" rel="stylesheet">
	<link href="{{asset('/admin/assets/plugins/pnotify/dist/pnotify.nonblock.css')}}" rel="stylesheet">
	<link href="{{asset('/admin/assets/plugins/chosen/chosen.min.css')}}" rel="stylesheet">
	
	 @stack('styles')
	<!-- favicon -->
	<link rel="shortcut icon" href="{{asset('/admin/assets/img/favicon.ico')}}" />
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
	<script>
	    var app_url = window.location.origin;
	</script>