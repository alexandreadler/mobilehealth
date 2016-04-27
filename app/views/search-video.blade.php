
@extends("layout.main-mobile")
@section("content")
	
    <script src="https://www.google.com/jsapi" type="text/javascript"></script>

	<div data-role="page" data-title="Search">

	    <div role="main" class="ui-content jqm-content jqm-fullwidth">
		
			@if(isset($r))
				
				@for($x = 0; $x < $w; $x++)
					<div class="video">
						<span class="thumbnail">
							<a href="{{url("/app/video/" . $r[$x]['videoId'])}}">
							<img src="{{$r[$x]['thumbnailDefautlUrl']}}" align="left" />
							<p class="title">{{Str::limit($r[$x]['title'],40)}}</p>
							<p class="desc">{{ Str::limit($r[$x]['description'], 120) }}</p>
							</a>
						</span>
					</div>

				@endfor
				
			@else
				
				{{"Sem resultados"}}
			
			@endif
		</div><!-- /content -->

	</div><!-- /page -->

@stop

@section("style")

    .thumbnail {
        display: block;
        height: 120px;
    }

    .thumbnail img {
        margin: 5px !important;
    }
    .thumbnail .title {
        padding: 2px 5px 0;
        margin: 0;
        font-weight: bold;
        font-size: 0.8em
    }
    .thumbnail .desc {
        font-size: 0.7em;
        padding: 2px 0;
        margin: 0;
    }
    .thumbnail a {
        text-decoration: none;
        color: #000 !important;
        font-weight: normal;
    }

@stop

