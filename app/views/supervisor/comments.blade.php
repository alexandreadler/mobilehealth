@extends("layout.main-mobile")


@section("content")

	@if(isset($posts))
		@if(!empty($posts))
			@foreach($posts as $p)
				<div class="post" style="overflow-x: hidden;">
					<div class="headPost">
						<div class="imgPost" >
							<img id="picture" src="{{url('/imgs/'.$p->photo)}}" />
						</div>
					</div>
								
					<div class="contentPost"> 
						<div class="namePost">
							{{$p->name_first}}
						</div>
									
						<div class="textPost">

							<p>{{$p->texto}}</p>
							@if(strcmp($p->imagem, ' ') != 0)
								{{ HTML::image('imgs/'.$p->imagem, '') }}
							@endif
											
							<!-- Caso o texto tenha algum link do youtube -->
							@if(!empty($p->thumburl))
								<div class="video">
									<span class="thumbnail" >
										<a href="{{url("/app/video/" . $p->vid."/".$p->person)}}" target="new">
											<img src="{{$p->thumburl}}" align="left" />
											<p class="title">{{Str::limit($p->title,40)}}</p>
											<p class="desc">{{ Str::limit($p->description, 120) }}</p>
										</a>
									</span>
								</div>
									
											
							@endif
								
							<p style="font-size: 10px; color: gray;">{{$p->create_at}}</p>
								
						</div>
									
						<div class="divBottom">
							<ul class="bottom">
								<a id="alikep" onclick="like('{{url('app/likep?id='.$p->id.'&from='.$p->person)}}');mudaFundoLikep('{{$p->id}}');" href="#"><li id="likep{{$p->id}}" class="bottomli"><img src="{{url('/imgs/ok.png')}}" /></li></a>
								<a id="aulikep" onclick="unlike('{{url('app/unlikep?id='.$p->id.'&from='.$p->person)}}');mudaFundoUnLikep('{{$p->id}}');" href="#"><li id="unlikep{{$p->id}}" class="bottomli" ><img src="{{url('/imgs/naoOK.png')}}" /></li></a>
								<a id="acomp" onclick="comp('{{url('app/compp?id_post='.$p->id.'&from='.$p->person)}}');mudaFundoCompp('{{$p->id}}');" href="#" ><li id="compp{{$p->id}}" class="bottomli"><img src="{{url('/imgs/compartilhar.png')}}" /></li></a>
							</ul>
						</div>
		
									
					</div>
				</div>


				<div id="comments" class="comments" >
					
					@if(isset($comments))
						@if(!empty($comments))
							@foreach($comments as $com)

						
								<div class="" style="overflow: auto; margin-top: 10px; padding-bottom: 10px; border-bottom: solid 1px black;">
																	
									<div style="float:left; margin-left: 10px; "> 
										<div  style=" float: clear;">
											<img id="pictureComments" src="{{url('/imgs/'.$com->photo)}}" />
										</div>
									</div>
																	
									<div style="float:left; width: 70%;">
										<div style="border-bottom: solid 1px gray; margin-left: 10px; width: 30%;">
											{{$com->name_first}}
										</div>
																		
										<div style="float: clear; margin: 10px 0px 0px 15px; max-width: 100%;">
												{{$com->text}}
										</div>
									</div>
								</div>
													
								
						@endforeach
					@endif
				@endif

				
							<form id="form" style="margin: 10px;" action="{{url('/app/comments')}}" method="post" enctype="multipart/form-data">
						 
									<label for="name">Escreva sobre isso: </label>
									<input type="textAread" name="comment" id="comment" style="width: 100%">
									<input type="textAread" name="idPost" id="idPost" style="width: 100%" value="{{$p->id}}" hidden>
									

								</form>
								
								 <div class="ui-bar ui-bar-a" style="height: 44px;">
									<a id="save" data-rel="save" class="btn btn-default btn-sm ui-mini ui-btn ui-btn-inline ui-alt-icon ui-nodisc-icon ui-icon-home" style="margin: 0;">Publicar</a>
								</div>



				</div>








			@endforeach
		@else
			Sem Resultados.
		@endif
	@else
		Sem Resultados.
	@endif
	


@stop






@section('script')


	$('#save').click(function(){
		$('#form').submit()
	});

	
	
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
			overflow-y:scroll; 
			height:400px;
			
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


