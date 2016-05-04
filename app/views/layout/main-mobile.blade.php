<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>MobiLEHealth</title>

	<!-- Core CSS - Include with every page -->
	<link href="{{ asset("css/cerulean/bootstrap.min.css") }}" rel="stylesheet">
	<link href="{{ asset("js/jquery.mobile-1.4.5/jquery.mobile-1.4.5.css") }}" rel="stylesheet">
	<script src="{{asset("js/functions.js")}}"></script>

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

		#profile ul { 
			margin: 0; /* retira o recuo para alguns browsers */ (*)
			padding: 0; /* retira o recuo para outros browsers */ (*)
			
		}
		
		#profile #menu li {
			border-bottom:1px solid #a4a0f5;
			text-decoration: none;
			list-style-type: none;
			text-align: center;
			padding: 5px;
		}
		
		#profile #menu li a:link {
			text-decoration: none;
			font-family: Geneva, Arial, Helvetica, sans-serif; /* define o tipo de fonte */ 
			font-size:14px;
			
		}
		
		#profile #menu li a {
			display:block;			
		}

		#profile #menu li a:hover {
			background-color: #FFE4B5; /* cor do fundo */
			color: #DAA520; /* cor da fonte */
			display:block; (*) 
		}
		
		#profile{
			margin-top: 10%;
			background: white;
			width: auto;
			height: auto;
			border: solid 1px white;
			position: absolute;
			z-index: 6;
			border-radius: 0px 5px 5px 0px;
			-webkit-box-shadow: -1px -1px 40px 10px rgba(0,0,0,0.75);
			-moz-box-shadow: -1px -1px 40px 10px rgba(0,0,0,0.75);
			box-shadow: -1px -1px 40px 10px rgba(0,0,0,0.75);
			display:none;
			overflow: initial;
		
		}
	
		.divisions_profile {
			margin-top: 10px;
			clear: left;
			overflow: auto;
			border-top: solid 1px gray;
			text-align: center;
		}
	
		#profile_picture {
			width: auto;
			float: left;
			margin-right: 5px;
			overflow: auto;
			text-align: left;
			
		}
		
		#profile_picture #picture {
			float: left;
			display: block;
			border-radius: 50%;
			background-position: -15px -15px;
			height: 80px;
			width: 80px;
		}
		
		#name {
			
			float: left;
			display: block;
			width: 30%;
			height: 30%;
			padding-top: 10%;
			text-aling: left;
		}
		
		
		
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

    <div id="header" data-role="header" data-position="fixed" data-theme="a" style="overflow:hidden; /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#9ee88b+1,92c413+100 */
		background: #92c413; /* Old browsers */
		background: -moz-linear-gradient(top,  #92c413 0%, #9ee88b 100%); /* FF3.6-15 */
		background: -webkit-linear-gradient(top,  #92c413 0%,#9ee88b 100%); /* Chrome10-25,Safari5.1-6 */
		background: linear-gradient(to bottom,  #92c413 0%,#9ee88b 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#92c413', endColorstr='#9ee88b',GradientType=0 ); /* IE6-9 */ ">
        <a href="#" onclick="perfil()" data-rel="home" class="btn btn-default btn-lg ui-btn ui-btn-left ui-alt-icon ui-nodisc-icon ui-corner-all ui-icon-carat-l" style="background: green; padding:0; width:30px ; height: 30px; "><span style="color: white;font-size: 25px; font-famil: aharoni; display:block;">=</span></a>
        <h1 style="color: white;"><strong>@if(isset($title)){{$title}} @else Home @endif</strong></h1>
        <a href="{{url("/users/logout")}}" data-rel="logout" class="btn btn-default btn-lg ui-btn ui-btn-right ui-alt-icon ui-nodisc-icon ui-corner-all ui-icon-home" style="margin: 0;"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
		
	</div>
		<div id="profile">
			<ul id="menu">
				<li>
					<a href="{{url("/")}}">
						<div class="divisions_profile"> 
							<a href="{{url("/profile")}}">
								<div id="profile_picture">			
									<img id="picture" src="{{url("/imgs/27_1.jpg")}}" />
								</div>
								
								<div id="name" >
									
									{{Session::get('fullName');}}
									
								</div>
							</a>
						</div>
					</a>
				</li> 
				
				<li>
					<a href="{{url("/")}}">Feed</a>
				</li> 
				
				<li>
					<a href="{{url("/")}}">Perfil</a>
				</li> 
				
				<li>
					<a href="{{url("/app/inbox")}}">Mensagens</a>
				</li> 
				
				<li>
					<a href="{{url("/phr")}}">Saúde</a>
				</li> 
				
				<li>
					<a href="{{url("/users/logout")}}"><span class="glyphicon glyphicon-log-out"> Sair</a>
				</li> 
				
			</ul>
		
		</div>
		
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
