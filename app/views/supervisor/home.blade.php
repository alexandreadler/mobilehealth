@extends("layout.main-mobile")

@section("content")

<div data-role="page" data-title="Supervisor - Home">

    <div class="TabControl">

        <div id="header" style="overflow: auto;">
            <ul class="abas" style="clear: both;">
                <li onclick="aba(0)"> 
                    <div class="aba" id="recommandation">
                        <span ><b >Analisar Fontes</b></span>
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
            <div class="conteudo"  id="Rec">
                <div role="main" class="ui-content jqm-content jqm-fullwidth">

                    <div class="ui-corner-all custom-corners">
                        <div class="ui-bar ui-bar-a"> 
                            <h3>Avaliar Conteúdo</h3>
                        </div>

                        <div class="ui-body ui-body-a">
                            @if(!empty($aux))
                            @for($i =0; $i < count($aux); $i++)
                            <div class="video" style="overflow: auto;">
                                <span class="thumbnail" style="height: auto;">

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
                                            		<a id="like" href="supervisor/aprovarfonte/{{$aux[$i][1]}}" class="active ui-btn ui-corner-all ui-icon-delete fa fa-thumbs-up" style="font-size:10px;"> Aprovar Fonte</a>
                                            		<a id="unlike" href="supervisor/reprovarfonte/{{$aux[$i][1]}}" class="ui-btn ui-corner-all ui-icon-delete fa fa-thumbs-down" style="font-size:10px;"> Reprovar Fonte</a>
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
                                            		<a id="like" href="supervisor/aprovarfonte/{{$aux[$i][1]}}" class="active ui-btn ui-corner-all ui-icon-delete fa fa-thumbs-up " style="font-size:10px;"> Aprovar Fonte</a>
                                            		<a id="unlike" href="supervisor/reprovarfonte/{{$aux[$i][1]}}" class="ui-btn ui-corner-all ui-icon-delete fa fa-thumbs-down" style="font-size:10px;"> Reprovar Fonte</a>
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
                    <p align="right"><a href="{{url('supervisor/novoconteudo/')}}">Novo Contéudo</a> | <a href="{{url('supervisor/novosupervisor/')}}">Novo Supervisor</a> | <a href="{{url('supervisor/pesquisarconteudo/')}}">Editar Contéudo</a></p>
                </div><!-- /content -->
            </div><!-- /Rec -->














            <!-- *************************************** Feed **************************************************** -->




            <div class="conteudo" id="Feed">

                <div id="userpost" style="margin: 20px;">
                    <h4>Compartilhe suas esperiências</h4>
                    <form id="form" action="{{url('app/publicacao')}}" method="post" enctype="multipart/form-data">
                        <textArea id="texto" name="texto"> </textArea>
						<input type="file" id="imagem" name="imagem">
					</form>
					
					<div class="ui-bar ui-bar-a" style="height: 44px;">
						<a id="save" data-rel="save" class="btn btn-default btn-sm ui-mini ui-btn-right ui-btn ui-btn-inline ui-alt-icon ui-nodisc-icon ui-icon-home" style="margin: 0;">Publicar</a>
					</div>
				</div>
                
				@if(isset($posts))
					@if(!empty($posts))
						@foreach($posts as $p)
							<div class="post" >
								<div class="headPost">
                                                                    <a href="{{url('profile/personalpagefriend/'.$p->person)}}">
                                                                        <div class="imgPost" >
                                                                                <img id="picture" src="imgs/{{$p->photo}}" />
                                                                        </div>
                                                                    </a>
								</div>
								
								<div class="contentPost"> 
									<div class="namePost">
                                                                            {{$p->name_first}}
									</div>
									
									<div class="textPost">

											<p>
											{{$p->texto}}
											
											<!-- Caso o texto tenha algum link do youtube -->
											@if(!empty($p->thumburl))
												<div class="video">
													<span class="thumbnail" >
														<a href="{{url("/app/video/" . $p->vid."/".$p->person)}}" target="new">
														<img src="{{$p->thumburl}}" align="left" />
														<p class="title">{{Str::limit($p->title,40)}}</p>
														<p class="desc">{{Str::limit($p->description, 120) }}</p>
														</a>
													</span>
												</div>
										
											
											@endif
											
											
										</p>
										
										@if(strcmp($p->imagem, ' ') != 0)
											<img width="60%" id="imageFromPost" src="imgs/{{$p->imagem}}" />			
										@endif
                                                                                
                                                                                <p style="font-size: 10px; color: gray;">{{$p->create_at}}</p>
									</div>
									
									<div class="divBottom">
										<ul class="bottom">
											<a id="alikep" onclick="like('app/likep?id={{$p->id}}& from={{$p->person}}'); mudaFundoLikep('{{$p->id}}');" href="#"><li id="likep{{$p->id}}" class="bottomli"><img src="{{url('/imgs/ok.png')}}" /></li></a>
											<a id="aulikep" onclick="unlike('app/unlikep?id={{$p->id}}& from={{$p->person}}'); mudaFundoUnLikep('{{$p->id}}');" href="#"><li id="unlikep{{$p->id}}" class="bottomli" ><img src="{{url('/imgs/naoOK.png')}}" /></li></a>
											<a id="acomp" onclick="comp('app/compp?id_post={{$p->id}}& from={{$p->person}}'); mudaFundoCompp('{{$p->id}}');" href="#" ><li id="compp{{$p->id}}" class="bottomli"><img src="{{url('/imgs/compartilhar.png')}}" /></li></a>
										</ul>
										
													
										<!-- Comentários para um post-->
										<div style="width: 75%; height: 50px; text-align: center; "><p style="margin-top: 15px;"><a href="{{url('app/comments/'.$p->id)}}" onclick="comments()" style="text-decoration: none;">Comente sobre isso</a></p></div>
										
										
									</div>
									
								</div>
							</div>
						@endforeach
					@else
						Sem Resultados.
					@endif
				@else
					Sem Resultados.
				@endif
			
			</div><!-- /Feed -->
			
			
			
		</div><!-- /content -->

	</div><!-- /TabControl -->
</div><!-- /page -->

@stop


@section('script')
	
	
	function like(link){
	
	$.ajax({
				url: link,
				type: "GET",
				data: { sim: link},
				dataType: "html",
				success: function(sucesso){
					$('#retornodoresultado').html(sucesso);
					
				},
				beforeSend: function () {
					$('#carregando').css({display: "block"});
				},
				complete: function () {
					$('#carregando').css({display: "none"});
				},
				error: function(){
					$('#retornodoresultado').html('Desculpe pelo transtorno, houve um erro, tente novamente.');
				}
		});
		return false;
			

}



function unlike(link){
	
	$.ajax({
				url: link,
				type: "GET",
				data: { sim: link},
				dataType: "html",
				success: function(sucesso){
					$('#retornodoresultado').html(sucesso);
					
				},
				beforeSend: function () {
					$('#carregando').css({display: "block"});
				},
				complete: function () {
					$('#carregando').css({display: "none"});
				},
				error: function(){
					$('#retornodoresultado').html('Desculpe pelo transtorno, houve um erro, tente novamente.');
				}
		});
		return false;
			

}


function comp(link){
	
	$.ajax({
				url: link,
				type: "GET",
				data: { sim: link},
				dataType: "html",
				success: function(sucesso){
					alert("Você compartilhou esse conteúdo");
					
				},
				beforeSend: function () {
					$('#carregando').css({display: "block"});
				},
				complete: function () {
					$('#carregando').css({display: "none"});
				},
				error: function(){
					$('#retornodoresultado').html('Desculpe pelo transtorno, houve um erro, tente novamente.');
				}
		});
		return false;
			

}

function mudaFundoLike(div){
	
	$("#like"+div).css('border', 'solid 2px blue');
	$("#unlike"+div).css('border', 'solid 1px gray');
	
}


function mudaFundoUnLike(div){
	
	$("#unlike"+div).css('border', 'solid 2px blue');
	$("#like"+div).css('border', 'solid 1px gray');
	
}

function mudaFundoComp(div){
	
	$("#comp"+div).css('border', 'solid 2px blue');

	
}


function mudaFundoLikep(div){
	
	$("#likep"+div).css('border', 'solid 2px blue');
	$("#unlikep"+div).css('border', 'solid 1px gray');
	
}


function mudaFundoUnLikep(div){
	
	$("#unlikep"+div).css('border', 'solid 2px blue');
	$("#likep"+div).css('border', 'solid 1px gray');
	
}

function mudaFundoCompp(div){
	
	$("#compp"+div).css('border', 'solid 2px blue');

	
}
	


	function aba(a) { 
		if(a == 0){
			
			$("#Rec").show();
			$("#recommandation").css('color', 'green'); 
			$("#recommandation").css('border-bottom', 'solid 1px green');
			$("#feed").css('border-bottom', 'solid 1px white');
			$("#feed").css('color', 'gray'); 
			$("#Feed").hide(); 
			 
			
			
		} else {
			$("#Feed").show(); 
			$("#feed").css('color', 'green');
			$("#feed").css('border-bottom', 'solid 1px green');
			$("#recommandation").css('color', 'gray');
			$("#recommandation").css('border-bottom', 'solid 1px white');
			$("#Rec").hide(); 
			
			
		}
	
	}
	
	
	
	$('#save').click(function(){
		$('#form').submit()
	});
	

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

			clear:both;

			//width:100%; 
			//overflow-y:scroll; 
			//overflow: auto;
			
		} 
		
		.TabControl #header{ 
			width:100%; 
			cursor:hand;
			
		} 
		
		.TabControl #content{
			width:100%; 
			height: 500px;
			margin-botton: 50%;
			
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

		
		.TabControl .conteudo{
			width:100%; 
			display:block;
			color:#fff;
			border-radius: 5px 5px 0px 0px;
			
		}

		#Rec{
			display:block;
		}	
		
		#Feed{
			display:none;
		}
		
		
		
		.post{

			display:block;
			color: black;
			clear:both;
		}
		
		.imgPost {
			float: left;
			display:block;
			height: 80px;
			width: 80px;
			margin: 10px;
			
		}
		
		
		

		
			
		#picture {
			
			height: 80px;
			width: 80px;
		}
		
		
		
		
		
		.namePost {
			
			font-weight:bold;
			float:left;
			margin: 15px;
			
		}
		
		
		
		
		
		
		.imgPostComments {
			float: left;
			display:block;
			height: 50px;
			width: 50px;
			margin: 10px;
			
		}
		
		.imgPostComments {
			
			float: left;
			display:block;
			height: 50px;
			width: 50px;
			margin: 10px;
			
		}
		
		#pictureComments {
			
			height: 50px;
			width: 50px;
		}
                
                .contentPost{
			
			border-left: solid 2px gray;
			border-top: solid 2px gray;
			border-radius:5px 0 0 10px;
			margin: 15px;
			float:left;
			display:block;
			width: 100%;
			height: auto;
			
			
		}
		
		.textPost{
                
			margin: 5px;
                        clear: both;
			
		}
		
		.divBottom{
			
			padding: 0;
			margin: 0;
			
		}
		
		.bottom {
			margin:0;
			padding:0;
			display:block;
			overflow: auto;
		}
		
		.bottom li{
			margin:0;
			padding:0;
			display:block;
			list-style-type: none;
			border: solid 1px gray;
			float: left;
			width: 25%;
			text-align: center;
			border-radius:5px 5px 0 0;
			
		}
		
		.bottom li img{
			
			width: 15px;
			
		}

		
		

@stop


