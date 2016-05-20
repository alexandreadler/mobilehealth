@extends("layout.main-mobile")


@section("content")



<div class="TabControl">
	<div id="header" style="overflow: auto;">
		<ul class="abas" style="clear: both;">
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
		<div class="conteudo"  id="Rec">
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
										    <a id="like" href="app/likec?id={{$v->id}}&from=-1" class="active ui-btn ui-corner-all ui-icon-delete fa fa-thumbs-up "> Like</a>
										    <a id="unlike" href="app/unlikec?id={{$v->id}}&from=-1" class="ui-btn ui-corner-all ui-icon-delete fa fa-thumbs-down"> Unlike</a>
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
		
		
		<div class="conteudo" id="Feed">
		
		
			@if(isset($c))
				@if(!empty($c))
					@foreach( $c as $v )
						<div class="post" >
							<div class="headPost">
								<div class="imgPost" >
									<img id="picture" src="{{Session::get('profilePicture')}}" />
								</div>
							</div>
							
							<div class="contentPost" style="background: rgb(220, 255, 200)"> 
								<div class="namePost" >
									Recomendações para você
								</div>
								
								<div class="textPost" >
									<div class="video">
										<span class="thumbnail" >
											<a href="{{url("/app/video/" . $v['vid'])}}" target="new">
											<img src="{{$v['thumburl']}}" align="left" />
											<p class="title">{{Str::limit($v['title'],40)}}</p>
											<p class="desc">{{ Str::limit($v['description'], 120) }}</p>
											</a>
										</span>
									</div>
								</div>
								
								<div class="divBottom">
									<ul class="bottom">
									<!-- O -1 serve para identificar que o conteudo foi uma recomendação-->
										<a id="alike" onclick="like('app/likec?id={{$v['id']}}&from=-1');mudaFundoLike('{{$v['id']}}');"  href="#"><li id="like{{$v['id']}}" class="bottomli"><img src="{{url('/imgs/ok.png')}}" /></li></a>
										<a id="aulike" onclick="unlike('app/unlikec?id={{$v['id']}}&from=-1');mudaFundoUnLike('{{$v['id']}}');" href="#"><li id="unlike{{$v['id']}}" class="bottomli"><img src="{{url('/imgs/naoOK.png')}}" /></li></a>
										<a id="acomp" onclick="comp('app/comp?id_content={{$v['id']}}&from=-1');mudaFundoComp('{{$v['id']}}');" href="#" ><li id="comp{{$v['id']}}" class="bottomli"><img src="{{url('/imgs/compartilhar.png')}}" /></li></a>
									</ul>
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
		
		@if(isset($contents))
			@if(!empty($contents))
				@foreach($contents as $con)
						<div class="post" >
							<div class="headPost">
								<div class="imgPost" >
									<img id="picture" src="imgs/{{$con->photo}}" />
								</div>
							</div>
							
							<div class="contentPost"> 
								<div class="namePost">
								{{$con->name_first}}
								</div>
								
								<div class="textPost">
									
									@if(!empty($con->thumburl))
										<div class="video">
											<span class="thumbnail" >
												<a href="{{url("/app/video/" . $con->vid)}}" target="new">
												<img src="{{$con->thumburl}}" align="left" />
												<p class="title">{{Str::limit($con->title,40)}}</p>
												<p class="desc">{{ Str::limit($con->description, 120) }}</p>
												</a>
											</span>
										</div>
								
									@else
								
								
										<p>{{$con->title}}</p>
										<img src="{{$con->thumburl}}" align="left" />
										<p>
											<a href="app/url?a={{$con->url_online}}" target="new">{{$con->description}}</a>
												
										</p>
									
									@endif
								</div>
								
								<div class="divBottom">
									<ul class="bottom">
										<a id="alike" onclick="like('app/likec?id={{$con->id}}&from={{$con->id_person}}');mudaFundoLike('{{$con->id}}');" href="#"><li id="like{{$con->id}}" class="bottomli"><img src="{{url('/imgs/ok.png')}}" /></li></a>
										<a id="aulike" onclick="unlike('app/unlikec?id={{$con->id}}&from={{$con->id_person}}');mudaFundoUnLike('{{$con->id}}');" href="#"><li id="unlike{{$con->id}}" class="bottomli" ><img src="{{url('/imgs/naoOK.png')}}" /></li></a>
										<a id="acomp" onclick="comp('app/comp?id_content={{$con->id}}&from={{$con->id_person}}');mudaFundoComp('{{$con->id}}');" href="#" ><li id="comp{{$con->id}}" class="bottomli"><img src="{{url('/imgs/compartilhar.png')}}" /></li></a>
									</ul>
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
		</div>
		
		

	</div>

	
</div>

@stop



@section("script")

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

	function aba(a) 
	{ 
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
		
	}
		
	#picture {
		margin: 10px;
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
		border-radius:5px 0 0 0;
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
	
	.ativa span, .selected span{
		color:#fff;
	}
	
	
@stop

