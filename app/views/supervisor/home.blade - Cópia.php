@extends("layout.main-mobile")
@section("content")

	<div data-role="page" data-title="Supervisor - Home">

	    <div role="main" class="ui-content jqm-content jqm-fullwidth">

            <div class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a"> 
                    <h3>Avaliar Conteúdo</h3>
                </div>
                <div class="ui-body ui-body-a">
						
					@if(!empty($relates))
					
							@foreach( $relates as $p )
							
								<div class="video">
									 {{ucfirst($p->name_first) }} {{ ucfirst($p->name_last)}}
									<span class="thumbnail">
										<a href="{{url("/supervisor/avaliarconteudo/".$p->id)}}">
										<!-- ucfirst([string]) Deixa a primeira letra da String maiúscula -->
										<span><b>Doença: @if ($p->disease == "diabetes")<img src={{URL::to('imgs/circuloazul.png')}} alt="Símbolo Mundial da Díabetes" height="30" width="30" /> {{ucfirst($p->disease)}} @else <img src={{URL::to('imgs/Cornflowerblue.png')}} alt="Símbolo Mundial da Díabetes" height="30" width="30" /> {{ucfirst($p->disease)}}</b>@endif</span>
										<br/>
										<b style="margin-left:15px; color:rgb(185,185,185);">Sexo: @if ($p->gender == '1') <span style="margin-top: 5px; color:rgb(0, 128,255);">Masculino</span> @else <span style="margin-top: 5px; color:rgb(255, 132,193);">Feminino</span> @endif</b>
										<br />
										<span style="margin-left:15px; color:rgb(185,185,185);">E-mail:</span> {{$p->email}}

										</a>
									</span>
								</div>
								
							@endforeach
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
			<p align="right"><a href="{{url("/supervisor/novosupervisor/")}}">Novo Supervisor</a></p>
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








