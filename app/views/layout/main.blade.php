<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>MobiLEHealth</title>

	<!-- Core CSS - Include with every page -->
	<link href="{{ asset("css/cerulean/bootstrap.min.css") }}" rel="stylesheet">
{{--	<link href="{{ asset("js/jquery.mobile-1.4.5/jquery.mobile-1.4.5.css") }}" rel="stylesheet">--}}
    <link rel="stylesheet" type="text/css" media="print" href="{{ asset("css/bootstrap.min.css") }}">
	<link href="{{ asset("css/font-awesome-4.2.0/css/font-awesome.css") }}" rel="stylesheet">

	<!-- Page-Level Plugin CSS - Dashboard -->
	<link href="{{ asset("css/main.css") }}" rel="stylesheet">

	<!-- Core Scripts - Include with every page -->
	<script src="{{ asset("js/jquery-1.10.2.js") }}"></script>
{{--	<script src="{{ asset("js/jquery.mobile-1.4.5/jquery.mobile-1.4.5.js") }}"></script>--}}
	<script src="{{ asset("js/bootstrap.min.js") }}"></script>
	<script src="{{ asset("js/plugins/metisMenu/jquery.metisMenu.js") }}"></script>

	<!-- Page-Level Plugin Scripts - Dashboard -->
	<!-- // <script src="{{ asset("js/plugins/morris/raphael-2.1.0.min.js") }}"></script> -->
	<!-- // <script src="{{ asset("js/plugins/morris/morris.js") }}"></script> -->

	<!-- SB Admin Scripts - Include with every page -->
	<script src="{{ asset("js/main.js") }}"></script>

	<!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
	<!-- // <script src="{{ asset("js/demo/dashboard-demo.js") }}"></script> -->

    <style>

    	@yield('style')


    </style>

	@yield('head')
	@yield('head2')

</head>

<body>

@yield('bodyfoot')

<div class="container">

	<div>
		<span class="navbar-nav navbar-left col-md-12 column logotipo">
		    <span>
			    <a href="{{URL::to('/')}}"></a>
			</span>
		</span>
	</div>

	<div class="row clearfix">
		<div class="col-md-12 column">

            {{--@if(Confide::user())--}}
			    {{--@include('layout.menu')--}}
            {{--@endif--}}

			<div class="row clearfix">
				<div class="col-lg-12 column">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title hidden-print">

                                <h4 style="color: white; font-size: 1.4em; font-weight: bold; text-align: center; padding-top: 0; margin: 10px 0;">MobiLEHealth</h4>

							</h3>
						</div>
						<div class="panel-body">

							@yield('content')

						</div>
						<div class="panel-footer">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


</body>

<script>
	
	@yield('script')

</script>

@yield('foot')

</html>