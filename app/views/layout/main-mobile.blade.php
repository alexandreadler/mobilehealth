<!DOCTYPE html>
<html>



<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>MobiLEHealth</title>

	<!-- Core CSS - Include with every page -->
	<link href="{{ asset("css/cerulean/bootstrap.min.css") }}" rel="stylesheet">
	<link href="{{ asset("js/jquery.mobile-1.4.5/jquery.mobile-1.4.5.css") }}" rel="stylesheet">

	<link href="{{ asset("css/jquery-mobile-font-awesome-master/css/jqm-font-awesome-isvg-ipng.css") }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" media="print" href="{{ asset("css/bootstrap.min.css") }}">
	<link href="{{ asset("css/font-awesome-4.2.0/css/font-awesome.css") }}" rel="stylesheet">

	<!-- Page-Level Plugin CSS - Dashboard -->
	<link href="{{ asset("css/main.css") }}" rel="stylesheet">

	<!-- Core Scripts - Include with every page -->
	<script src="{{ asset("js/jquery-1.10.2.js") }}"></script>

    <script type="text/javascript">
        $(document).bind("mobileinit", function () {
            $.mobile.ajaxEnabled = false;
        });
    </script>

	<script src="{{ asset("js/jquery.mobile-1.4.5/jquery.mobile-1.4.5.js") }}"></script>
	<script src="{{ asset("js/bootstrap.min.js") }}"></script>

    <style>

    	@yield('style')

    	.left {
    		float: left;
    		width: 78%;
    		margin-right: 2%;
    	}
    	.right {
    		float: right;
    		width: 20%;
    	}
    	.ui-input-search {
    		margin: 0;
    	}
    	button.ui-btn {
    		margin: 0;
    	}		

        /* Button down */
        .ui-page-theme-b .ui-btn,
        html .ui-bar-b .ui-btn,
        html .ui-body-b .ui-btn,
        html body .ui-group-theme-b .ui-btn,
        html head + body .ui-btn.ui-btn-b {

            background: #cedce7;
            background: -moz-linear-gradient(top,  #cedce7 0%, #596a72 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#cedce7), color-stop(100%,#596a72));
            background: -webkit-linear-gradient(top,  #cedce7 0%,#596a72 100%);
            background: -o-linear-gradient(top,  #cedce7 0%,#596a72 100%);
            background: -ms-linear-gradient(top,  #cedce7 0%,#596a72 100%);
            background: linear-gradient(to bottom,  #cedce7 0%,#596a72 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cedce7', endColorstr='#596a72',GradientType=0 );

            /*color: #97310E;*/
            border-color: #596a72;

            color: 					#fff /*{b-bdown-color}*/;
            text-shadow: 0 /*{b-bdown-shadow-x}*/ 1px /*{b-bdown-shadow-y}*/ 0 /*{b-bdown-shadow-radius}*/ #111 /*{b-bdown-shadow-color}*/;
        }

        .ui-page-theme-b .ui-btn.ui-btn-active, html .ui-bar-b .ui-btn.ui-btn-active, html .ui-body-b .ui-btn.ui-btn-active, html body .ui-group-theme-b .ui-btn.ui-btn-active, html head + body .ui-btn.ui-btn-b.ui-btn-active, .ui-page-theme-b .ui-checkbox-on:after, html .ui-bar-b .ui-checkbox-on:after, html .ui-body-b .ui-checkbox-on:after, html body .ui-group-theme-b .ui-checkbox-on:after, .ui-btn.ui-checkbox-on.ui-btn-b:after, .ui-page-theme-b .ui-flipswitch-active, html .ui-bar-b .ui-flipswitch-active, html .ui-body-b .ui-flipswitch-active, html body .ui-group-theme-b .ui-flipswitch-active, html body .ui-flipswitch.ui-bar-b.ui-flipswitch-active, .ui-page-theme-b .ui-slider-track .ui-btn-active, html .ui-bar-b .ui-slider-track .ui-btn-active, html .ui-body-b .ui-slider-track .ui-btn-active, html body .ui-group-theme-b .ui-slider-track .ui-btn-active, html body div.ui-slider-track.ui-body-b .ui-btn-active {
            color: 					#333 /*{b-bdown-color}*/;
            text-shadow: 0 /*{b-bdown-shadow-x}*/ 1px /*{b-bdown-shadow-y}*/ 0 /*{b-bdown-shadow-radius}*/ #FFF /*{b-bdown-shadow-color}*/;
            border-color: #777;
        }

        /* Button down */
        .ui-page-theme-b .ui-btn-active,
        html .ui-bar-b .ui-btn-active,
        html .ui-body-b .ui-btn-active,
        html body .ui-group-theme-b .ui-btn-active,
        html head + body .ui-btn.ui-btn-active {

            background: #eeeeee;
            background: -moz-linear-gradient(top,  #eeeeee 0%, #cccccc 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#cccccc));
            background: -webkit-linear-gradient(top,  #eeeeee 0%,#cccccc 100%);
            background: -o-linear-gradient(top,  #eeeeee 0%,#cccccc 100%);
            background: -ms-linear-gradient(top,  #eeeeee 0%,#cccccc 100%);
            background: linear-gradient(to bottom,  #eeeeee 0%,#cccccc 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 );

            /*color: #97310E;*/
            border-color: #cccccc;

            color: 					#fff /*{b-bdown-color}*/;
            text-shadow: 0 /*{b-bdown-shadow-x}*/ 1px /*{b-bdown-shadow-y}*/ 0 /*{b-bdown-shadow-radius}*/ #111 /*{b-bdown-shadow-color}*/;
        }

        #header a {
            float: right;
        }

    </style>

</head>

<body>

    <div id="header" data-role="header" data-position="fixed" data-theme="a" style="overflow:hidden;">
        <a href="{{url("/")}}" data-rel="home" class="btn btn-default btn-lg ui-btn ui-btn-left ui-alt-icon ui-nodisc-icon ui-corner-all ui-icon-carat-l" style="margin: 0;"><span class="glyphicon glyphicon-home"></span> Home</a>
        <h1><strong>@if(isset($title)){{$title}} @else Home @endif</strong></h1>
        <a href="{{url("/users/logout")}}" data-rel="logout" class="btn btn-default btn-lg ui-btn ui-btn-right ui-alt-icon ui-nodisc-icon ui-corner-all ui-icon-home" style="margin: 0;"><span class="glyphicon glyphicon-log-out"></span> Logout</a>

        @if(isset($show_search) and $show_search)

            <div id="search_bar" data-theme="a" class="ui-bar ui-bar-a">
                <form id="search-form" action="{{url("app/search-video")}}" method="get">
                    <div class="left">
                        <label for="search" class="ui-hidden-accessible">Search Input:</label>
                        <input type="search" name="search" id="search" value="@if(isset($q)){{$q}}@endif" placeholder="Search...">
                    </div>
                    <div class="right">
                        <button type="button" class="ui-btn ui-btn-a ui-corner-all ui-mini" onclick="videoSearch()">Video</button>
                        <button type="button" class="ui-btn ui-btn-a ui-corner-all ui-mini" onclick="webSearch()">Web</button>
                    </div>
                </form>
            </div>

        @endif

    </div>

    @yield("content")

	<div data-role="footer" data-position="fixed" data-theme="b">
		<div data-role="navbar">
			<ul>
				<li><a @if(isset($title) && $title == "Profile") class="ui-btn-active" @endif href="{{url("/profile")}}" data-icon="user" data-prefetch="true" data-transition="slide">Profile</a></li>
				<li><a @if(isset($title) && $title == "Search") class="ui-btn-active" @endif href="{{url("app/search")}}" data-icon="search" data-prefetch="true" data-transition="slide">Search</a></li>
				<li><a @if(isset($title) && $title == "My Health") class="ui-btn-active" @endif href="{{url("/phr")}}" data-icon="gear" data-prefetch="true" data-transition="slide">My Health</a></li>
				<li><a @if(isset($title) && $title == "Social") class="ui-btn-active" @endif href="{{url("app/social")}}" data-icon="refresh" data-prefetch="true" data-transition="slide">Social</a></li>
			</ul>
		</div><!-- /navbar -->
	</div><!-- /footer -->

</body>

<script>
	
    $(function(){

        $(function() {
            $( "[data-role='navbar']" ).navbar();
            $( "[data-role='header'], [data-role='footer']" ).toolbar();
        });

        $( document ).on( "pagecontainerchange", function() {
            var current = $( ".ui-page-active" ).jqmData( "title" );

            $( "[data-role='header'] h1" ).text( current );
            $( "[data-role='navbar'] a.ui-btn-active" ).removeClass( "ui-btn-active" );
            $( "[data-role='navbar'] a" ).each(function() {
                if ( $( this ).text() === current ) {
                    $( this ).addClass( "ui-btn-active" );
                }
            });
        });

    });

    function videoSearch() {
        $('#search-form').attr('action','{{url("app/search-video")}}');
        $('#search-form').submit();
    }

    function webSearch() {
        $('#search-form').attr('action','{{url("app/search-web")}}');
        $('#search-form').submit();
    }

    @yield("script");

</script>

</html>
