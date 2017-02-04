@extends("layout.main-mobile")


@section("content")

	<div data-role="page" data-title="Home">

	    <div role="main" class="ui-content jqm-content jqm-fullwidth">

            <div class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a">
                    <h3>Avaliar Videos</h3>
                </div>
                <div class="ui-body ui-body-a">
                    @if(isset($c))
						@if(!empty($c))
							@foreach( $c as $v )
								@if(!empty($v->thumburl))
									<div class="video" style="overflow: auto;">
											<span class="thumbnail" style="height: auto;">
												<a href="{{url("/supervisor/video/" . $v->id)}}">
												<img src="{{$v->thumburl}}" align="left" />
												<p class="title">{{Str::limit($v->title,40)}}</p>
												<p class="desc">{{ Str::limit($v->description, 120) }}</p>
												</a>
											
											</span>
									</div>
								
								@else
									
										<div class="video">
										
											<span class="thumbnail">
												<a href="{{url($v->url_online)}}" target="new">
													<img style="float:left" width="100px" height="100px" src="http://s.wordpress.com/mshots/v1/{{urlencode($v->url_online)}}?w=100&h=100" />
													
													<p class="title">
														{{$v->title}}
													</p>
													
													<p class="desc">
														{{ Str::limit($v->description, 120) }}
													</p>
													
												</a>
												<div id="likes" data-role="controlgroup" data-type="horizontal" data-mini="true">
											    	<a id="like" href="{{url("supervisor/aprovarconteudo/".$v->id)}}" class="active ui-btn ui-corner-all ui-icon-delete fa fa-thumbs-up "> Aprovar Fonte</a>
											    	<a id="unlike" href="{{url("supervisor/reprovarconteudo/".$v->id)}}" class="ui-btn ui-corner-all ui-icon-delete fa fa-thumbs-down"> Reprovar Fonte</a>
												</div>
											</span>
											
										</div>
									
								@endif
									
							@endforeach
						@else
							Sem Resultados.
						@endif
						
						
                    @else
                         Sem Resultados.
                    @endif
                </div>
            </div>
            <br>
			
			
			
			
			
            <br>
            <div class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a">
                    <h3>Novas Mensagens</h3>
                </div>
                <div class="ui-body ui-body-a">
					@if(isset($message))
						@if(!empty($message))
							@foreach( $message as $m )
									
									<a href="app/viewmessage?id_person_from={{$m->id_person_from}}" data-rel="popup" data-position-to="window" data-transition="pop"><p>{{Str::limit(($m->name_first .$m->name_last), 20)}}</p></a>
									
							@endforeach
							
						@else
							Sem Resultados.
						@endif
					@else
						Sem Resultados.
					@endif
                </div>
            </div>

		</div><!-- /content -->

	</div><!-- /page -->

@stop


@section("style")

	#like {
        background: #7B7;
    }
    #like:hover {
        background: #BEB;
    }

    #unlike {
        background: #E66;
    }
    #unlike:hover {
        background: #F88;
    }

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
        font-weight: normal;
        padding: 2px 0;
        margin: 0;
    }
    .thumbnail a {
        text-decoration: none;
        color: #000 !important;
        font-weight: normal;
    }

@stop








