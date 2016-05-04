@extends("layout.main-mobile")


@section("content")



<div class="TabControl">
	<div id="header">
		<ul class="abas">
			<li onclick="aba(0)"> 
				<div class="aba" id="recommandation">
					<span ><b >Recomenda&ccedil&otilde;es</b></span>
				</div>
			</li>
			<li onclick="aba(1)">
				<div class="aba" id="feed">
					<span><b>Feed</b></span>
				</div>
			</li>			
		</ul>

	</div>
	
	
	<div id="content">
	
		
	
		<div class="conteudo"  id="Rec" >
		
			<div class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a" style="border-radius:5px 5px 0px 0px;">
                    <h3>Videos recomendados</h3>
                </div>
                <div class="ui-body ui-body-a">
						@if(isset($c))
							@if(!empty($c))
								@foreach( $c as $v )
									<div class="video">
										<span class="thumbnail">
											<a href="{{url("/app/video/" . $v['vid'])}}">
											<img src="{{$v['thumburl']}}" align="left" />
											<p class="title">{{Str::limit($v['title'],40)}}</p>
											<p class="desc">{{ Str::limit($v['description'], 120) }}</p>
											</a>
										</span>
									</div>
								@endforeach
							@else
								Sem Resultados.
							@endif						
						@else
							 Sem Resultados.
						@endif
                </div>
            </div> 	
			
			
			<div class="ui-corner-all custom-corners" >
                <div class="ui-bar ui-bar-a" style="border-radius:5px 5px 0px 0px;">
                    <h3>Links Recomendados.</h3>
                </div>
                <div class="ui-body ui-body-a">
									
					@if(isset($c2))
						@if(!empty($c2))
						@foreach( $c2 as $v )
								
								<a href="app/url?a={{$v->url_online}}" target="new">
									<p class="title">
										{{Str::limit($v->title,40)}}
										<div id="likes" data-role="controlgroup" data-type="horizontal" data-mini="true">
										    <a id="like" href="app/likec?id={{$v->id}}" class="active ui-btn ui-corner-all ui-icon-delete fa fa-thumbs-up "> Like</a>
										    <a id="unlike" href="app/unlikec?id={{$v->id}}" class="ui-btn ui-corner-all ui-icon-delete fa fa-thumbs-down"> Unlike</a>
										</div>
										
									</p>
								</a>

                        @endforeach
						
						@else
							Sem Resultados.
						@endif
					
					@else
						Sem Resultados.
					@endif
				  
                </div>
            </div>
			
			
			<div class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a" style="border-radius:5px 5px 0px 0px;">
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
			
			
			
		</div>
		
		
		<div class="conteudo" id="Fed">
			
		</div> 

	</div>

	
</div>

@stop


@section("script")

	function aba(a) 
	{ 
		if(a == 0){
			
			$("#Rec").show();
			$("#recommandation").css('color', 'green'); 
			$("#recommandation").css('border-bottom', 'solid 1px green');
			$("#feed").css('border-bottom', 'solid 1px white');
			$("#feed").css('color', 'gray'); 
			$("#Fed").hide(); 
			 
			
			
		} else {
			$("#Fed").show(); 
			$("#feed").css('color', 'green');
			$("#feed").css('border-bottom', 'solid 1px green');
			$("#recommandation").css('color', 'gray');
			$("#recommandation").css('border-bottom', 'solid 1px white');
			$("#Rec").hide(); 
			
			
		}
	
	}
	
	
	
	
	
	
	


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
	
	
	.TabControl{
		width:100%; 
		overflow:hidden; 
		height:400px;
		
	} 
	
	.TabControl #header{ 
		width:100%; 
		overflow:hidden; 
		cursor:hand;
		
	} 
	
	.TabControl #content{
		width:100%; 
		overflow:hidden; 
		height:100%;	
	}

	
	.TabControl .abas{
		display:block;
		list-style-type: none;
		padding: 0;
		
		
	}
	
	.TabControl .abas li{
		width: 50%;
		float:left;
	}
	

	
	.aba{
		width:100%;
		height:30px;
		border-radius:5px 5px 0 0;
		text-align:center;
		border-left: solid  1px #9ee88b;
		border-right: solid  1px #9ee88b;
		
	}
	
	
	.ativa span, .selected span{
		color:#fff;
	}
	
	.TabControl .conteudo{
		width:100%; 
		display:block; 
		height:100%;
		color:#fff;
		border-radius: 5px 5px 0px 0px;
	}	

@stop

