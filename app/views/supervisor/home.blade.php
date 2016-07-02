@extends("layout.main-mobile")


@section("content")

	<div data-role="page" data-title="Supervisor - Home">

	    <div role="main" class="ui-content jqm-content jqm-fullwidth">

            <div class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a"> 
                    <h3>Avaliar Conteúdo</h3>
                </div>
                <div class="ui-body ui-body-a">
					@if(!empty($aux))
							@for($i =0; $i < ($c); $i++)
								<div class="video">
									<span class="thumbnail">
										
										@if(!empty($aux[$i][2]))
											<!--Caso seja um video-->
											<img style="float:left" src="{{$aux[$i][2]}}" />
											<p>
												<b><a href="{{url("http://".$aux[$i][1])}}" target="new">Fonte: {{$aux[$i][1]}}</a></b> 
											</p>
											<p>
												
												@if($aux[$i][3] > 1)
													<a href="supervisor/avaliarlink/{{$aux[$i][1]}}">Analisar links separadamente</a> ({{$aux[$i][3]}})
												@endif
											</p>
											
											<div id="likes" data-role="controlgroup" data-type="horizontal" data-mini="true">
										    	<a id="like" href="supervisor/aprovarfonte/{{$aux[$i][1]}}" class="active ui-btn ui-corner-all ui-icon-delete fa fa-thumbs-up "> Aprovar Fonte</a>
										    	<a id="unlike" href="supervisor/reprovarfonte/{{$aux[$i][1]}}" class="ui-btn ui-corner-all ui-icon-delete fa fa-thumbs-down"> Reprovar Fonte</a>
											</div>
											
										@else
											<!--Caso seja um lik de site/pdf/outros -->
											<img style="float:left" width="100px" height="100px" src="http://s.wordpress.com/mshots/v1/{{$aux[$i][0]}}?w=100&h=100" />
											<p>
												<b style="font-color: blue"><a href="{{url("http://".$aux[$i][1])}}" target="new">Fonte: {{($aux[$i][1])}}</a></b>
											</p>
											<p>
												@if($aux[$i][3] > 1)
													<a href="supervisor/avaliarlink/{{$aux[$i][1]}}">Analisar links separadamente</a> ({{$aux[$i][3]}})
												@endif
											</p>
											
											<div id="likes" data-role="controlgroup" data-type="horizontal" data-mini="true">
										    	<a id="like" href="supervisor/aprovarfonte/{{$aux[$i][1]}}" class="active ui-btn ui-corner-all ui-icon-delete fa fa-thumbs-up "> Aprovar Fonte</a>
										    	<a id="unlike" href="supervisor/reprovarfonte/{{$aux[$i][1]}}" class="ui-btn ui-corner-all ui-icon-delete fa fa-thumbs-down"> Reprovar Fonte</a>
											</div>
										@endif
										
									</span>
								</div>
								
							@endfor
                    @else
                         Sem Resultados.
                    @endif
						
                </div>
            </div>
            <br>
			
            <div class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a">
                    <h3><h1><a href="{{url("/supervisor/acompanharnovo/")}}">Acompanhar Novo Pacinete</a></h1></h3>
                </div>

            </div>
			
			
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
			<p align="right"><a href="{{url("supervisor/novoconteudo/")}}">Novo Contéudo</a> | <a href="{{url("supervisor/novosupervisor/")}}">Novo Supervisor</a></p>
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








